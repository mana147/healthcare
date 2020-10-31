# coding: utf-8
import websockets
from websockets import WebSocketServerProtocol
import asyncio

import mysql.connector
import json
import bcrypt

import datetime
import input.api_server as API


class WSC_Server:

    def __init__(self, ip, port):
        self.clients = set()
        self.list_clinets = []
        self.loop = asyncio.get_event_loop()
        self._client_timeout = 1
        self._wake_up_task = None
        self.ip = ip
        self.port = port
        self.mess = ''
        self.full_client = 100000
        self.list_clinets_provider = []
        self.authen: object
        self.buffer_dict_id_index_client = {}
        # ================================================

    # ======================================================

    def Listen(self):
        print("listening on {}:{}".format(self.ip, self.port))

        ws_server = websockets.serve(self.connect_client, self.ip, self.port)
        asyncio.ensure_future(ws_server)

        try:
            self.loop.run_forever()
        
         # trường hợp ngắt cứng từ server 
         # yêu cầu disconnect toàn bộ client
         # xóa toàn bộ danh sách client 
         # update lại trạng thái offline trong database
        except KeyboardInterrupt:

            print(self.buffer_dict_id_index_client)

            for x in self.buffer_dict_id_index_client:
                print(x)

                if self.buffer_dict_id_index_client[x]['status'] == 'device':
                    # lấy toàn bộ client trong buffer 
                    # lấy index của từng client đang kết nối
                    index = self.buffer_dict_id_index_client[x]['index']
                    # update lại trạng thái offline khi đóng kết nôi
                    self.Execute_sql_update(self.Update_status('devices', 'status', 'id', str(index), 'offline'))
                    # xóa buffer data khi đóng kết nối
                    # self.Execute_sql_update(self.Delete_data('buffer_sokhambenh', 'user_id', str(var)))

                if self.buffer_dict_id_index_client[x]['status'] == 'website':
                    pass

            print(' > keyboard interrupt')
            # self.exit()

    # ======================================================

    async def connect_client(self, client: WebSocketServerProtocol, path):
        # ======================================================
        # print(client)
        # ======================================================

        self.clients.add(client)
        self.list_clinets.append(client.remote_address)

        print(' > new client connected from {}:{}'.format(*client.remote_address))
        # print(self.list_clinets)
        print(' > số lượng client kết nối : {} \nlist client đang kết nối : {} '.format(len(self.list_clinets), self.list_clinets))
        
        # ======================================================
        # tao buffer client
        buffer_dict = {
            client.remote_address: {
                'index': None,
                'status': 'null'
            }
        }

        self.buffer_dict_id_index_client.update(buffer_dict)        
        print(' > buffer {}'.format(self.buffer_dict_id_index_client))

        # ======================================================

        # check full client
        if len(self.list_clinets) > self.full_client:
            print('full client ')
            await self.disconnect_client(client)
        else:
            # asyncio.ensure_future(self.keep_alive(client))
            authen = asyncio.ensure_future(self.send_authen_check(client))
            # asyncio.ensure_future(self.handle_provider(client))
            # asyncio.ensure_future(self.controll_handle(client))

            # ======================================================================
            try:
                await asyncio.ensure_future(self.handle_messages_input(client, authen))
            except:
                # keep_alive_task.cancel()
                authen.cancel()
                await self.disconnect_client(client)
                print('> disconnect_client connect_client')

    # ======================================================

    async def handle_messages_input(self, client, authen):
        async for mess in client:

            #  kiểm tra trạng thái của client trong buffer
            if (self.buffer_dict_id_index_client[client.remote_address]['status'] == 'null'):
                await self.authen_check(client, mess, authen)

            elif (self.buffer_dict_id_index_client[client.remote_address]['status'] == 'device'):
                await self.handle_provide_device(client, mess)

            elif (self.buffer_dict_id_index_client[client.remote_address]['status'] == 'website'):
                await self.handle_provide_website(client, mess)

            else:
                print('> error !')

    # ======================================================
    # gửi 10 lần request đến client
    async def send_authen_check(self, client):
        try:
            for x in range(10):
                # sleep 1 s
                await asyncio.sleep(1)
                # gửi json request
                await client.send(API.api_request_id)
                # print(x)

            # sau 5 lần request
            await client.send(API.api_request_close)
            # disconnect_client
            await self.disconnect_client(client)

        except:
            # await self.disconnect_client(client)
            print("> stop send authen check ")

    # ======================================================

    async def authen_check(self, client, mess, authen):
        # handle json
        try:
            # chuyen mess sang dang json 
            messJson = json.loads(mess)

            #  kiểm tra trạng thái 
            if messJson['state'] == 'authen' and messJson['type'] == 'response':

                # ======================================================
                if messJson['value'] == 'get_id': 
                    id_device_json = messJson['data']['id']
                    data_device, id_index_of_device, _, status_of_device = self.handle_check_id_device_in_sql(id_device_json)
                    await self.handle_check_device(client, authen, data_device, status_of_device, id_index_of_device)
                
                # ======================================================
                if messJson['value'] == 'website':
                    id_userhw_json = messJson['data']['id']
                    data_user, id_device_of_user = self.handle_check_id_user_in_sql(id_userhw_json)
                    
                    await self.handle_check_user(client, authen, data_user, id_userhw_json, id_device_of_user)

            else:
                await client.send(API.api_request_close)
                await self.disconnect_client(client)

        # nếu không phải json báo lỗi
        except:
            await client.send(API.api_request_close)
            await self.disconnect_client(client)
    
    # ======================================================

    def handle_check_id_device_in_sql(self, id_device_json):
        try:
            data = self.Execute_sql(
                self.Select_id_device(
                    'devices',
                    'id_device',
                    id_device_json
                )
            )

            id_index_of_device = data[0][0]
            id_of_device = data[0][1]
            status_of_device = data[0][2]

            return data , id_index_of_device, id_of_device, status_of_device

        except:
            print('> Can not Execute_sql ')
    
    async def handle_check_device(self, client,  authen, data, status_of_device, id_index_of_device):
        #  nếu value_of_id_userhw không có data trả về => không có id_userhw trong database
        try:
            # if len(data) != 0 and bcrypt.checkpw(bytes(password_json, 'utf-8'), bytes(password_of_userhw, 'utf-8')) and status_of_userhw == 'offline':
            # if len(data) != 0 and status_of_device == 'offline':
            if len(data) != 0 :

                await client.send(API.api_request_pass)
                authen.cancel()
                # ======================================================
                #  update trạng thái online
                self.Execute_sql_update(self.Update_status(
                    'devices', 'status', 'id', str(id_index_of_device), 'online'))

                # tạo buffer data trong buffer_sokhambenh
                # self.Execute_sql_insert(self.Insert_data(
                #     'buffer_sokhambenh', str(id_index_of_device)))

                # ======================================================
                print('{} - {}'.format(id_index_of_device, client.remote_address))
                
                # ======================================================
                
                buffer_dict = {
                    client.remote_address: { 'index': id_index_of_device , 'status': 'device' } 
                }

                self.buffer_dict_id_index_client.update(buffer_dict)

                # ======================================================
                print(client.remote_address)

                print(' > obj {}'.format(self.buffer_dict_id_index_client))
                
                print(' > index {}'.format(self.buffer_dict_id_index_client[client.remote_address]['index']))
           
                # ======================================================
                self.list_clinets_provider.append(client.remote_address)
                # ======================================================
            else:
                await client.send(API.api_request_close)
                await self.disconnect_client(client)

        except:
            print("> ! fail")

    # ======================================================

    def handle_check_id_user_in_sql(self, id_user_json):
        try:
            data = self.Execute_sql(
                self.Select_id_device(
                    'users',
                    'id_userhw',
                    id_user_json
                )
            )

            id_device_of_user = data[0][2]

            return data, id_device_of_user

        except:
            print('> Can not Execute_sql ')

    async def handle_check_user(self, client,  authen, data, id_userhw_json, id_device_of_user):
        try:
            if len(data) != 0 :
                await client.send(API.api_request_pass)
                authen.cancel()
                # ===============================================
                buffer_dict = {
                    client.remote_address : {
                        'index': str(id_userhw_json),
                        'status': 'website',
                        'id_device': str(id_device_of_user)
                    }
                }
                self.buffer_dict_id_index_client.update(buffer_dict)

                print(self.buffer_dict_id_index_client[client.remote_address])
                # ===============================================
        except :
            print("> ! fail")

    # ======================================================

    async def handle_provide_device(self, client, mess):
        try:
            # chuyen mess sang dang json
            messJson = json.loads(mess)

            # kiểm tra có đúng api gọi provider không
            if messJson['state'] == 'provide' and messJson['type'] == 'request':

               # ======================================================
                
                if messJson['value'] == 'get_time':
                    x = datetime.datetime.now()
                    m = API.api_response_time("get_time",x.year, x.month, x.day, x.hour, x.minute, x.second)
                    await client.send(str(m))

                # ======================================================
                
                if messJson['value'] == 'push_sensor':
                    index = self.buffer_dict_id_index_client[client.remote_address]['index']
                    # print(index)
                    data = messJson['data']
                    # print(data)                    
                    
                    try:
                        oxygen = data['oxygen']
                    except :
                        oxygen = 0
                    
                    try:
                        bloodpressure = data['bloodpressure']
                    except :
                        bloodpressure = 0

                    try:
                        bodytemperature = data['bodytemperature']
                    except :
                         bodytemperature = 0

                    try:
                        heartbeat = data['heartbeat']
                    except:
                        heartbeat = 0

                    # print(' > {} - {} - {} - {}'.format(oxygen, bloodpressure, bodytemperature, heartbeat))

                    sql = self.Update_data_sensor(
                        'devices',
                        'id',
                        str(index),
                        str(oxygen),
                        str(bloodpressure),
                        str(bodytemperature),
                        str(heartbeat)
                    )

                    # print(sql)

                    try:
                        self.Execute_sql_update(sql)
                        await client.send(API.api_response_sensor_done)
                    except :
                        await client.send(API.api_response_sensor_fail)
                
                # ======================================================

                if messJson['value'] == 'push_info':
                    index = self.buffer_dict_id_index_client[client.remote_address]['index']
                    print(index)
                    data = messJson['data']
                    print(data)

                    sex = data['sex']
                    yearold = data['yearold']
                    high = data['high']
                    weight = data['weight']

                    sql = self.Update_data_info(
                        'devices',
                        'id',
                        str(index),
                        str(sex),
                        str(yearold),
                        str(high),
                        str(weight)
                    )
                    
                    print(sql)

                    try:
                        self.Execute_sql_update(sql)
                        await client.send(API.api_response_sensor_done)
                    except :
                        await client.send(API.api_response_sensor_fail)

                # ======================================================
                
                if messJson['value'] == 'get_sensor':
                    index = self.buffer_dict_id_index_client[client.remote_address]['index']
                    sql = self.Select_data(
                        'devices', # tên bảng cơ sở dữ liệu
                        'id',      # tên côt cần tìm 
                        str(index)  # giá trị trên cột cần tìm 
                    )

                    try:
                        data = self.Execute_sql(sql)[0]
                    except :
                        print("> error !")

                    m = API.api_response_sensor("get_sensor",data[3], data[4], data[5], data[6])
                    
                    await client.send(str(m))
                    
                # ======================================================

                if messJson['value'] == 'images':
                    pass
            
            else : 
                await client.send(API.api_request_error)

        except:
            await client.send(API.api_request_error)
            # await self.disconnect_client(client)

    # ======================================================

    async def handle_provide_website(self, client, mess):
        try:
            # chuyen mess sang dang json
            messJson = json.loads(mess)
            # kiểm tra có đúng api gọi provider không
            if messJson['state'] == 'provide' and messJson['type'] == 'request':
                
                # ======================================================

                if messJson['value'] == 'get_time':
                    x = datetime.datetime.now()
                    m = json.dumps(API.api_response_time(
                        "get_time", x.year, x.month, x.day, x.hour, x.minute, x.second))
                    await client.send(m)
                
                # ======================================================
               
                if messJson['value'] == 'get_sensor':
                    buffer_client_web = self.buffer_dict_id_index_client[client.remote_address]
                    buffer_id_device = buffer_client_web['id_device']
                    
                    sql = self.Select_id_device(
                        'devices', # tên bảng cơ sở dữ liệu
                        'id_device',      # tên côt cần tìm 
                        str(buffer_id_device)  # giá trị trên cột cần tìm
                    )
          
                    try:
                        data = self.Execute_sql(sql)[0]
                    except :
                        print("> error !")
                
                    m = json.dumps(API.api_response_sensor(
                        "get_sensor", data[3], data[4], data[5], data[6]))
                    
                    await client.send(m)    
                
                # ======================================================

                if messJson['value'] == 'get_info':
                    buffer_client_web = self.buffer_dict_id_index_client[client.remote_address]
                    buffer_id_device = buffer_client_web['id_device']
                    
                    sql = self.Select_id_device(
                        'devices', # tên bảng cơ sở dữ liệu
                        'id_device',      # tên côt cần tìm 
                        str(buffer_id_device)  # giá trị trên cột cần tìm
                    )

                    try:
                        data = self.Execute_sql(sql)[0]
                        # print (data)
                    except :
                        print("> error !")

                    m = json.dumps(API.api_response_info(
                        "get_info",data[7], data[8], data[9], data[10]))

                    # print (m)
                    
                    await client.send(m)

            else:
                await client.send(API.api_request_error)
        except:
            await client.send(API.api_request_error)

    # ======================================================

    async def disconnect_client(self, client):

        try :
            self.clients.remove(client)
            self.list_clinets.remove(client.remote_address)
        except :
            pass
        
        # self.list_clinets_provider.remove()
        #  kiem tra xem buffer_client có dịa chỉ của client không

        if (self.buffer_dict_id_index_client.get(client.remote_address) != None):
            
            if self.buffer_dict_id_index_client[client.remote_address]['status'] == 'device':
                # nếu có trong danh sách , thì lấy index của client ấy 
                index = self.buffer_dict_id_index_client[client.remote_address]['index']

                # update lại trạng thái offline khi đóng kết nôi
                self.Execute_sql_update(self.Update_status('devices', 'status', 'id', str(index), 'offline'))
                
                # lấy xong thì xóa client khỏi danh sách
                self.buffer_dict_id_index_client.pop(client.remote_address)
                
                # xóa buffer data khi đóng kết nối
                # self.Execute_sql_update(self.Delete_data('buffer_sokhambenh', 'user_id', str(var)))
            
            if self.buffer_dict_id_index_client[client.remote_address]['status'] == 'website':
                # xoa client khoi danh sachs
                print('clean {}'.format(
                    self.buffer_dict_id_index_client[client.remote_address]))


            self.buffer_dict_id_index_client.pop(client.remote_address)

        # ======================================================
        print('client {} disconnected'.format(client.remote_address))
        await client.close()

    # ======================================================

    async def keep_alive(self, client):
        n = 0 
        while True:
            n = n + 1 
            await asyncio.sleep(self._client_timeout)

            try:
                await asyncio.wait_for(client.ping(), self._client_timeout)
                await client.send(str(n))
                # print('> {} pinging {}:{}'.format(n, *client.remote_address))
            except:
                await self.disconnect_client(client)
                print ('break keep_alive')
                break 
    
    # ======================================================

    def exit(self):
        print("exiting")
        # self._wake_up_task.cancel()
        try:
            self.loop.run_until_complete(self._wake_up_task)
        except asyncio.CancelledError:
            self.loop.close()

     # ===================================================

   # ======================================================

    async def controll_handle(self, client):
        print('controll handle')

    # ===================================================
    # =================== My SQL ========================
    # ===================================================

    def config_mysql(self):
        mydb = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="iot_database"
        )
        return mydb

    # ===================================================

    def Execute_sql(self, sql):
        mydb = self.config_mysql()
        cursor = mydb.cursor()

        cursor.execute(sql)
        data = cursor.fetchall()

        cursor.close()
        mydb.close()

        return data

    def Execute_sql_update(self, sql):
        mydb = self.config_mysql()
        cursor = mydb.cursor()

        cursor.execute(sql)
        mydb.commit()

        cursor.close()
        mydb.close()

    def Execute_sql_insert(self, sql):
        mydb = self.config_mysql()
        cursor = mydb.cursor()

        cursor.execute(sql)
        mydb.commit()

        cursor.close()
        mydb.close()

    def Execute_sql_delete(self, sql):
        mydb = self.config_mysql()
        cursor = mydb.cursor()

        cursor.execute(sql)
        mydb.commit()

        cursor.close()
        mydb.close()

    # ===================================================

    def Select_table_user(self, table_name):
        sql = "SELECT * FROM `" + table_name + "`"
        return sql

    # ===================================================

    def Select_id(self, table_name, column_name, value):
        list_column = 'id,status,active,id_userhw,name,number,password,email,level,user_enable'
        sql = 'SELECT ' + list_column + \
            ' FROM ' + table_name + \
            ' WHERE ' + column_name + ' LIKE ' + '"' + value + '"'

        return sql
    
    # ===================================================

    def Select_id_device(self, table_name, column_name, value):
        sql = 'SELECT * FROM ' + table_name + \
            ' WHERE ' + column_name + ' LIKE ' + '"' + value + '"'
        return sql

    # ===================================================

    def Update_status(self, table_name, column_name, id_, index, value):
        #  example sql = "UPDATE `users` SET `status` = \'online\' WHERE `users`.`id` = 44";
        sql = "UPDATE `"+table_name+"` SET `"+column_name+"` = '" + \
            value+"' WHERE `"+table_name+"`.`"+id_+"` = "+index+""
        return sql

    # ===================================================

    def Insert_data(self, table_name, user_id):
        sql = "INSERT INTO `{}`(`id`, `user_id`) VALUES(NULL, '{}')".format(
            table_name, user_id)
        return sql
    
    # ===================================================
    
    def Delete_data(self, table_name, column_name, user_id):
        sql = "DELETE FROM `buffer_sokhambenh` WHERE `{}`.`{}` = {}".format(table_name, column_name, user_id)
        return sql

    # ===================================================

    def Update_data_sensor(self, table_name, column_name, user_id, oxy, huyet_ap, nhiet_do, nhip_tim):
        sql = "UPDATE `{0}` SET `oxy` = '{3}', `huyet_ap` = '{4}', `nhiet_do` = '{5}', `nhip_tim` = '{6}' WHERE `{1}` = {2}".format(table_name, column_name, user_id, oxy, huyet_ap, nhiet_do, nhip_tim)
        return sql

    # ====================================e===============

    def Update_data_info(self, table_name, column_name, user_id, sex , yearold, high, weight):
        sql = "UPDATE `{0}` SET `gioi_tinh` = '{3}', `nam_tuoi` = '{4}', `chieu_cao` = '{5}', `can_nang` = '{6}' WHERE `{1}` = {2}".format(table_name, column_name, user_id, sex , yearold, high, weight)
        return sql

    # ====================================e===============

    def Select_data(self, table_name, column_name, user_id ):
        sql = 'SELECT * FROM `{0}` WHERE `{1}` = {2}'.format(table_name, column_name, user_id)
        return sql

# ======================================================
