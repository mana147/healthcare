// ====================================================================
var id_kick_dropdown = $("#kick_dropdown");
var id_sokhambenh_kedon = $("#sokhambenh_kedon");

var id_so_kham_benh = $("#so_kham_benh");
// var id_ke_don_thuoc = $("#ke-don-thuoc");
var id_share_user_info = $("#share-user-info");

var id_input_search_id = $("#input-search-id");
// var id_uer_id = $("#id");
// var id_home_user_id = $("#home-user-id");
var id_button_search_id = $("#button-search-id");

var id_sensor = $("#sensor");
var id_chart_camera = $("#chart-camera");
var id_prescription = $("#donthuoc");
var id_list_data_thuoc = $("#list_data_thuoc");

var key_lock = true;
var key_lock_send_socket = false;

let data_user = {
    id: "",
    id_userhw: "",
    id_device:"",
    name: "",
    email: ""
};

// data sổ khám bệnh for user
let dataSoKhamBenh;
let data_main_user; 
let dataMember;

let websocket = new WebSocket("ws://itc-server.dynu.net:443/");

// ============================================================================================
// =========================================== MAIN ===========================================
// ============================================================================================

$(document).ready(function ()
{
    console.log("<!- START -!> ");

    // =========================================================

    $.ajax({
        async: false,
        type: "GET",
        url: "/getuserlogin",
        data: 'json',
        dataType: 'json',
    }).done(function (data_get) {
        // console.log(" get data success !> ");
        // kiểm tra xem data_get là user hay doctor
        // console.log(data_get);

        // hiển thị thông tin
        $("#home-user-id").html(html_id_user(data_get["name"], data_get["level"]));

        //  kiểm tra xem có id device hay chưa
        if (data_get['id_device'] == null) {

            //  lấy mã nguồn site input id device 
            $("#tab-main").html(get_view('/getinputiddevice'));

        } else {

            // lấy mã nguồn site tab main
            $("#tab-main").html(get_view('/getmaintab'));

            // hiển thị thông tin
            $("#id").html(html_id(data_get["id_userhw"], data_get["id_device"]));

            // kiểm tra xem client là user hay doctor
            if (data_get["level"] === "user" || data_get["level"] === "member") {
                $("#ke-don-thuoc").hide();
            }
            if (data_get["level"] === "doctor") {
                hide_show_html("hide");
            }

        }


        // tạo và ghi data vào cookie
        // $.cookie('id', data_get["id"], { expires: 1 });
        // $.cookie('id_userhw', data_get["id_userhw"], { expires: 1 });
        // $.cookie('name', data_get["name"], { expires: 1 });
        // $.cookie('email', data_get["email"], { expires: 1 });

        // ghi data vào biến để dùng lại ở các hàm khác
        data_user.id = data_get["id"];
        data_user.id_userhw = data_get["id_userhw"];
        data_user.name = data_get["name"];
        data_user.email = data_get["email"];
        data_user.id_device = data_get['id_device'];


    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus + ': ' + errorThrown);
    });

    // ===============================================================================
    if (data_user.id != null) {
        //  get data cho sổ khám bệnh
        $.ajax({
            async: true,
            type: "POST",
            url: "/postlistsokhambenh",
            data: { 'id': data_user.id_userhw },
            dataType: 'json',
        }).done(function (data) {
            dataSoKhamBenh = data;
            // console.log(data);
        });

         //  get data cho member
        $.ajax({
            async: true,
            type: "POST",
            url: "/postlistmember",
            data: { 'id_userhw': data_user.id_userhw },
            dataType: 'json',
        }).done(function (data) {
            // console.log(data);

            for (i = 0 ; i < data.length ; i++ )
            {
                // console.log(data[i]['id_member']);
                let id_member = data[i]['id_member'];
                let id_device = data[i]['id_device'];
                let onkich = 'onclick = func_members("' + id_member + '","' + id_device +'")';
                // console.log(onkich);

                let htmltab = '<li class="nav-item"> <a class="nav-link" data-toggle="tab" href = "#" '+onkich+'> ' + data[i]['name'] + '</a > </li > ';

                $("#hometab").after(htmltab);
            }
        });
    }



    // ===============================================================================
    //  đọc data từ cookie
    // data_user.id = $.cookie("id");
    // data_user.name = $.cookie("name");
    // data_user.email = $.cookie("email");

    // ===============================================================================

    // viết hàm gửi data về server
    //  data = thông tin cần tìm kiếm + id + name
    id_button_search_id.click(function (e) {
        e.preventDefault();
        console.log(id_input_search_id.val());
        id_search();
    });


     // ===============================================================================
    
    socket_getdata();
    
    // ===============================================================================
    console.log("<!- END -!> ");
    // console.log(data_user.id_userhw);
    // ===============================================================================
});


// ===============================================================================
function creattab() {
    $("#tab-creat").slideDown();
    $("#tab-creat").html(get_view('/getinputmember'));
    // $("#hometab").after(htmltab);
}

function func_members(id_member, id_device) {
    // // hiển thị thông tin
    $("#tab-creat").slideUp("slow");
    $("#id").html(html_id(id_member, id_device));

    // lấy data sổ khám bệnh cho user
    get_list_sokhambenh(id_member);
    console.log(dataSoKhamBenh);
    key_lock = true;
}

// ===============================================================================
// sổ khám bệnh
function soKhamBenh() {
    console.log("so kham benh");

    key_lock_send_socket = false;
    // console.log(dataSoKhamBenh);

    if (key_lock == true) {
        $("#list_menu").empty();
        $("#list_menu").append(Function_render_list_scroll_so_kham_benh(dataSoKhamBenh));
        key_lock = false;
    };
}

// ======================================================================
function id_search() {
    let id_search = id_input_search_id.val()
    let check = false;
    let datalog = "";

    // gửi data về server / POST
    // begin postid
    $.ajax({
        async: false,
        type: "POST",
        url: "postid",
        data: { 'id_userhw': id_search },
        dataType: 'json',
    }).done(function (data) { // done lay dc data
        // log data
        console.log(data);
        //  kiểm tra id có void không
        if (data['id'] != null) {
            datalog = data['id'];
            //  kiểm tra điều kiện nhóm đối tượng cho phép đc thấy hồ sơ
            // console.log("nhóm đối tượng :" + data["user_enable"]);

            let user_enable = JSON.parse(data["user_enable"]);
            let obj_user_enable = user_enable.list;
            // console.log(obj_user_enable);
            for (x = 0; x < obj_user_enable.length; x++) {
                // console.log(obj_user_enable[x]);
                // kiểm tra xem tên bác sỹ có trong dánh sách ADD người dùng hay không
                if (data_user.id_userhw == obj_user_enable[x]) {
                    // console.log('ok >>>>');
                    //  kiểm tra nếu người tìm kiếm là user thì sẽ hiển thị bảng thông tin
                    if (data["level"] === "user") {
                        hide_show_html('show');
                    } else {
                        hide_show_html('hide');
                    }
                    // hien thi thong tin
                    id_uer_id.html(html_id(data["name"], data["id_userhw"], data["email"]));
                    // console.log(data['id']);
                    // tạo và ghi data vào cookie
                    $.cookie('id', data['id'], { expires: 1 });
                    $.cookie('id_userhw', data["id_userhw"], { expires: 1 });

                    check = true;
                }
            }
            if (check == false) {
                alert("Bạn không thể xem thông tin USER này");
            }

        } else {
            alert("không có id người dùng trong data");
        }

    }).fail(function (jqXHR, textStatus, errorThrown) {  // fail <======
        console.log(textStatus + ': ' + errorThrown);
        alert("không có id người dùng trong data");
    });
    // end postid
    // ======================================================================

    if (check == true) {
        // console.log(">>>>>>> true");
        $.ajax({
            async: false,
            type: "POST",
            url: "/postsokhambenh",
            data: { 'id': datalog },
            dataType: 'json',
        }).done(function (data) {
            // console.log(data);
            dataSoKhamBenh = data;
        });
    };
    // ======================================================================
};

// ======================================================================

function html_id( id, id_device ) {
    let html = '<h4 style="color: rgba(0,123,255,0.8);"> \
               <i class="far fa-id-card" style="font-size: 30px;color: rgba(0,123,255,0.8);"> \
               </i>&nbsp; ID : '+ id + ' | DEVICE : ' + id_device +'&nbsp;</h4>'

    return html;
}

// ===============================================================================
function html_id_user(name, level) {
    let html = '<h3 style="color: rgb(0,123,255);"> \
    <i class="fas fa-user-md" style="font-size: 50px;"> \
    </i>&nbsp;Home - Healthcare : ' + name + ' (' + level + ')' + '&nbsp;</h3>'

    return html;
}
// ===============================================================================

function Function_info(x)
{    
    console.log(dataSoKhamBenh);

    var id_heartbeat = $("#heartbeat");
    var id_oxy = $("#oxy");
    var id_blood_pressure = $("#blood_pressure");
    var id_body_temp = $("#body_temp");
    var id_tall = $("#tall");
    var id_weight = $("#weight");
    var id_old = $("#old");
    var id_sex = $("#sex");
    var id_chuandoanbenh_out = $('#chuandoanbenh_out');
    var id_list_data_thuoc = $("#list_data_thuoc");
    
    id_heartbeat.text(dataSoKhamBenh[x]["nhip_tim"]);
    id_oxy.text(dataSoKhamBenh[x]["oxy"]);
    id_blood_pressure.text(dataSoKhamBenh[x]["huyet_ap"]);
    id_body_temp.text(dataSoKhamBenh[x]["nhiet_do"]);
    id_tall.text(dataSoKhamBenh[x]["chieu_cao"]);
    id_weight.text(dataSoKhamBenh[x]["can_nang"]);
    id_old.text(dataSoKhamBenh[x]["tuoi"]);
    id_sex.text(dataSoKhamBenh[x]["gioi_tinh"]);

    // show don thuoc
    id_chuandoanbenh_out.html("<strong> Chuẩn đoán bệnh : </strong> " + dataSoKhamBenh[x]["chuan_doan"]);
    let obj = JSON.parse(dataSoKhamBenh[x].don_thuoc)
    id_list_data_thuoc.empty();

    for (let x = 0; x < obj.list.length; x++) {
        // show đơn thuốc
        // id_kedonxong.fadeIn();
        let n = obj.list[0].name;
        let dv = obj.list[0].dv;
        let sl = obj.list[0].sl;
        let ld = obj.list[0].ld;

        // ghi và hiển thị bảng đơn thuốc
        id_list_data_thuoc.append(html_div_list_data_thuoc(n, dv, sl, ld));
    };
};

// ===============================================================================

function html_div_list_data_thuoc(n, dv, sl, ld) {
    var div_list_html = '<tr>\
    <td>'+ String(n) + '<br></td>\
    <td>'+ String(dv) + '</td>\
    <td>'+ Number(sl) + '</td>\
    <td>'+ String(ld) + '&nbsp;</td>\
    </tr>\ ';

    return String(div_list_html)
};

// ===============================================================================

function Function_calss_btn_light(x) {
    var txt1 = '<a class="btn btn-light" onclick="Function_info(' + x + ' )">'
    var txt2 = data_0.numb[x].date;
    var txt3 = data_0.numb[x].status;
    var txt4 = '</a>';
    var t = txt1 + txt2 + txt3 + txt4

    console.log(t);

    return t;
}
// ===============================================================================

function Function_render_list_scroll_so_kham_benh(data) {
    console.log(data);

    let html = "";
    for (x = 0; x < data.length; x++) {
        html = html + '<a class= btn btn-light  onclick=Function_info(' + x + ')>' + data[x]["date"] + ' - ' + data[x]["chuan_doan"] + '</a>';
    }
    var html_1 = '<div data-spy=scroll data-target=#myScrollspy style= " height:400px ; overflow-y: scroll ">';
    var html_2 = '</div>';
    return html_1 + html + html_2;

}

// =========================================================================

function hide_show_html(x) {
    if (x == 'show') {
        id_sensor.show();
        id_chart_camera.show();
        id_prescription.show();
        id_sokhambenh_kedon.show();
    } else {
        id_sensor.hide();
        id_chart_camera.hide();
        id_prescription.hide();
        id_sokhambenh_kedon.hide();
    }
}

// =========================================================================

function check_key(i, k) {

    let json = {
        id: i ,
        key_active: k
    };

    $.ajax({
        async: false,
        type: "POST",
        url: "/postcheckkey",
        data: json,
        dataType: 'json',
    }).done(function (data) {
        location.reload();
    }).fail(function (jqXHR, textStatus, errorThrown) {
        // If fail
        alert('kích hoạt thất bại');
        console.log(textStatus + ': ' + errorThrown);
    });
    
}

// =========================================================================

function get_view(url) {
    let getdata;
    $.ajax({
        async: false,
        type: "GET",
        url: String(url),
        success: function (data) {
            getdata = data;
        }
    });

    return getdata;
}

function get_list_sokhambenh(id) {
    $.ajax({
        async: false,
        type: "POST",
        url: "/postlistsokhambenh",
        data: { 'id': id },
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            dataSoKhamBenh = data;
        }            
    }); 
}

// =========================================================================

function Function_SetIdDevice() {
    var x = $("#idDevice").val();

    let json = {
        "id": data_user.id,
        "id_device": x 
    }

    // console.log(json);

    $.ajax({
        async: false,
        type: "POST",
        url: "/postiddevice",
        data: json,
        dataType: 'json',
    }).done(function (data) {
        // log data
        // console.log(data);
        alert("bạn đã đăng ký id thiết bị thành công");
        location.reload();
    });
}
// =========================================================================

function Function_SetIdMember() {
    var n = $("#nMember").val();

    // console.log(x);
    
    let json = {
        "id": data_user.id,
        "id_userhw" : data_user.id_userhw,
        "id_device": data_user.id_device,
        "nameMember": n
    }

    console.log(json);

    $.ajax({
        async: false,
        type: "POST",
        url: "/postmember",
        data: json,
        dataType: 'json',
    }).done(function (data) {
        // log data
        console.log(data);
        alert("bạn đã đăng ký thành viên thành công");
        location.reload();
    });
}

function Function_RemoveMember() {
    var idMember = $("#idMember").val();
    // console.log(idMember);

    let json = {
        "id_member": idMember,
    }
    
    console.log(json);

    $.ajax({
        async: false,
        type: "POST",
        url: "/postremovemember",
        data: json,
        dataType: 'json',
    }).done(function (data) {
        // log data
        // console.log(data);

        if (data == 'ok') {
            alert("bạn đã xóa thành viên thành công");
        } else {
            alert(" ERROR !");
        }
        location.reload();
    });
}

// =========================================================================
function Roottab() {
    // location.reload()
    // hiển thị thông tin
    $("#id").html(html_id(data_user.id_userhw, data_user.id_device));
    $("#tab-creat").slideUp("slow");

     // lấy data sổ khám bệnh cho user
    get_list_sokhambenh(data_user.id_userhw);
    console.log(dataSoKhamBenh);
    key_lock = true;
}

// =========================================================================

function socket_getdata() {
    
    let json_authen = '{"state":"authen","type":"response","value":"website","data":{"id":"'+data_user.id_userhw+'"}}';
    let json_get_time = '{"state":"provide","type":"request","value":"get_time"}';
    let json_get_sensor = '{ "state": "provide", "type": "request", "value": "get_sensor" }';
    let json_get_info = '{"state":"provide","type":"request","value":"get_info"}';
    let check = "close";

    var timeLoop;

    var id_heartbeat = $("#heartbeat");
    var id_oxy = $("#oxy");
    var id_blood_pressure = $("#blood_pressure");
    var id_body_temp = $("#body_temp");
    var id_tall = $("#tall");
    var id_weight = $("#weight");
    var id_old = $("#old");
    var id_sex = $("#sex");


    // ==================================================

    websocket.onopen = function (evt) {
        console.log("CONNECTED");
        websocket.send(json_authen);
    };

    websocket.onmessage = function (evt) {
        // console.log(evt.data);
        var obj = JSON.parse(evt.data);
        // =================================================
        if (obj.state == 'authen') {
            if (obj.value == 'pass') {
                // websocket.send(json_get_info);
                setInterval(loop_time_get_sensor, 500);

            } else {
                websocket.close();
            }

        } else if (obj.state == 'provide') {
            // console.log(obj.value);

            if (obj.value == 'get_sensor') {
                // console.log(obj.data);

                id_heartbeat.text(obj.data.heartbeat);
                id_oxy.text(obj.data.oxygen);
                id_blood_pressure.text(obj.data.bloodpressure);
                id_body_temp.text(obj.data.bodytemperature);

            };

            if (obj.value == 'get_info') {
                // console.log(obj.data);

                id_tall.text(obj.data.high);
                id_weight.text(obj.data.weight);
                id_old.text(obj.data.yearold);
                id_sex.text(obj.data.sex);

            };

        } else {
            websocket.close();
        };

        // websocket.close();
    };

    websocket.onclose = function (evt) {
        console.log("DISCONNECTED");
    };

    websocket.onerror = function (evt) {
        // console.log(evt);
    };

    function loop_time_get_sensor() {
        if (key_lock_send_socket == true) {
            websocket.send(json_get_sensor);
        }
    };

    function get_info() {
        websocket.send(json_get_info);
    };

}

function set_data_sensor() {
    key_lock_send_socket = true;
    console.log('set_data_sensor');
}