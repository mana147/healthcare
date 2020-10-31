// ======================================================
// https://github.com/websockets/ws

const fs = require('fs');
const UUID = require("node-uuid");
const WebSocket = require("ws");
// ======================================================

var os = require('os');
var networkInterfaces = os.networkInterfaces();
// console.log(networkInterfaces);

// ======================================================
// connfig options server
const WebSocketServer = new WebSocket.Server({
    port: 8080
});
// ======================================================
let clients = [];

const readline = require("readline");
const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

// ======================================================
const mysql = require("mysql");
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'iot_database',

});
// =====================================================

function connect() {

    return new Promise(function (resolve, reject) {

        connection.connect(function (err) {
            if (err) {
                reject('error connecting: ')
            } else {
                resolve('connected as id ' + connection.threadId)
            }
        });

    })
}


// =====================================================

connect().then(
    function (resolve) {
        console.log(resolve)
    },
    function (reject) {
        console.log(reject)
    }
);


// ======================================================

// viết hàm lấy toàn bộ table
// input : *
// output :  data

function Select_table(table_name) {
    let sql = "SELECT * FROM `" + table_name + "`";
    connection.query(sql, (e, r, f) => {
        log(r);
    });
}

// ==================================================

//  viết hàm tìm kiếm theo id 
//  input : nhập tên bảng : Table
//        : nhập tên cột 
//        : nhập số id 
// output : data 

function Select_id(table_name, column_name, value) {

    // SELECT column1, column2, column3, . . . .
    // FROM table_name
    // WHERE condition (tên cột , toán tử so sánh , giá trị)

    let list_column =
        'id,\
        active,\
        id_userhw,\
        name,\
        number,\
        email,\
        level,\
        user_enable';

    let sql =
        'SELECT ' + list_column +
        ' FROM ' + table_name +
        ' WHERE ' + column_name + ' = ' + value;

    return new Promise(function (resolve, reject) {
        connection.query(sql, function (err, result) {
            if (err) {
                return reject('err' + err)
            } else {
                resolve(result);
            }
        });
    });
}

// ==================================================

// ==================================================


// let numb = 0;
// function noop() {
//     ++numb;
//     log('ping ' + numb);
// }

setInterval( function ping () {
    WebSocketServer.clients.forEach(function each(ws) {
        if (ws.isAlive === false) return ws.terminate();
        ws.isAlive = false;
        ws.ping();
    });
}, 1000);

// function heartbeat() {
//     this.isAlive = true;
// }

// ======================================================
function broadcast(clientId, message) {
    WebSocketServer.clients.forEach(function (client) {
        if (client.readyState === WebSocket.OPEN) {
            client.send(`[${clientId}]: ${message}`);
        }
    });
}
// ======================================================
function log(str) { console.log(str) }

// ======================================================

log("Start WebSocket Server ");
// ======================================================ex
// event: 'connection' 
WebSocketServer.on('connection', function (wsocket, Request) {

    // ======================================================
    function chat() {
        rl.question("chat to client : ", function (str) {
            wsocket.send(`${str}`);
        });
    }
    // ======================================================

    // UUID dung để xác định từng client đã kết nối với server 
    wsocket.id = UUID.v4();

    const id = wsocket.id;
    const ip = Request.socket.remoteAddress;

    // tạo một kết nối mới 
    console.log(' >>>>>>>>>> Creat a new connect  <<<<<<<< ');
    console.log('client [ %s ] [ %s ] connected  ' , id  , ip);

    clients.push(
        {
            "id": id,
            "ip": ip 
        }
    );


    // console.log(clients);

    wsocket.send('hello client ID [' + id + ']');
    
    // ping / pong
    wsocket.isAlive = true;
    wsocket.on('pong', function heartbeat () {
        this.isAlive = true;
    });

    // ==========================================================
    // nhận message từ client 
    wsocket.on('message', function (message) {

        // nhận đc message từ client có ID
        console.log(id + ' : ' + message);

        wsocket.send(message);

        // broadcast(id, message);

        // if (message == 'close') {
        //     wsocket.close();
        // }


        // Select_id('users', 'id', '4')
        //     .then(
        //         (data) => {
        //             if (String(data).length != 0) {

        //                 wsocket.send(data);

        //                 console.log(data);
        //             } else {
        //                 console.log('data = void ')
        //             }
        //         },
        //         (err) => {
        //             log(err);
        //         }
        //     );


        // function Select_table(table_name) {
        //     let sql = "SELECT * FROM `" + table_name + "`";
        //     connection.query(sql, (e, r, f) => {
        //         console.log(r);

        //         wsocket.send(r);
        //     });
        // }

        // Select_table('users');


    });
    // ==========================================================
    // client disconnect server 
    wsocket.on('close', function (code, reason) {

        // var index = clients.indexOf(socket);
        // clients.splice(index, 1);
        console.log('client [ %s ] [ %s ] disconnected ', id  , code  );
    });
    // ==========================================================
    // chat();
    // ==========================================================
});

// WebSocketServer.close();

// ======================================================
// event: 'close' 
WebSocketServer.on('close', function close() {
    // clearInterval(interval);
});
// ======================================================
// event: 'error'
WebSocketServer.on('error', function error(Error) {
    console.log(Error);
});
// ======================================================