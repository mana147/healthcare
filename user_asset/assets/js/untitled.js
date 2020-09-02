// ====================================================================
var id_list_menu = $("#list_menu");
var id_kick_dropdown = $("#kick_dropdown");

var id_sokhambenh_kedon = $("#sokhambenh_kedon");

var id_so_kham_benh = $("#so_kham_benh");
var id_ke_don_thuoc = $("#ke-don-thuoc");
var id_share_user_info = $("#share-user-info");

var id_heartbeat = $("#heartbeat");
var id_oxy = $("#oxy");
var id_blood_pressure = $("#blood_pressure");
var id_body_temp = $("#body_temp");
var id_tall = $("#tall");
var id_weight = $("#weight");
var id_old = $("#old");
var id_sex = $("#sex");

var id_input_search_id = $("#input-search-id");
var id_uer_id = $("#id");
var id_home_user_id = $("#home-user-id");
var id_button_search_id = $("#button-search-id");

var id_sensor = $("#sensor");
var id_chart_camera = $("#chart-camera");
var id_prescription = $("#donthuoc");
var id_list_data_thuoc = $("#list_data_thuoc");
var id_chuandoanbenh_out = $('#chuandoanbenh_out');

var key_lock = true;

let data_user = {
    id: "",
    id_userhw: "",
    name: "",
    email: ""
};

// data sổ khám bệnh for user
let bigdata;

// ============================================================================================
// =========================================== MAIN ===========================================
// ============================================================================================

$(document).ready(function () {

    console.log("<!- START -!> ");
    // ===============================================================================

    // sổ khám bệnh
    id_so_kham_benh.click(function (e) {
        console.log("so kham benh");
        // console.log(bigdata);
        if (key_lock == true) {
            id_list_menu.append(Function_render_list_scroll_so_kham_benh(bigdata));
            key_lock = false;
        };
    });

    // ===============================================================================

    let data_main_user;

    // get data từ server

    $.ajax({

        async: false,

        type: "GET",

        url: "/getuserlogin",

        data: 'json',

        dataType: 'json',

    }).done(function (data_get) {

        // console.log(" get data success !> ");

        // kiểm tra xem data_get là user hay doctor
        if (data_get["level"] === "user" || data_get["level"] === "member") {
            id_ke_don_thuoc.hide();
            data_main_user = data_get["id"];
        }

        if (data_get["level"] === "doctor") {
            hide_show_html("hide");
        }

        // hiển thị thông tin
        id_home_user_id.html(html_id_user(data_get["name"], data_get["level"]));

        id_uer_id.html(html_id(data_get["name"], data_get["id_userhw"], data_get["email"]));

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

    }).fail(function (jqXHR, textStatus, errorThrown) {

        console.log(textStatus + ': ' + errorThrown);

    });

    if (data_main_user != null) {
        $.ajax({
            async: false,
            type: "POST",
            url: "/postsokhambenh",
            data: { 'id': data_main_user },
            dataType: 'json',
        }).done(function (data) {
            // console.log(data);
            bigdata = data;
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


        // console.log("id_button_search_id");

        // console.log("data_user.id_userhw = " + data_user.id_userhw);

        // lấy value từ form

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
                bigdata = data;
            });
        }
        // ======================================================================
    });

    // ===============================================================================
    console.log("<!- END -!> ");
    // ===============================================================================
});

// ======================================================================
// ======================================================================

function html_id(name, id, email) {
    let html = '<h4 style="color: rgba(0,123,255,0.8);"> \
               <i class="far fa-id-card" style="font-size: 30px;color: rgba(0,123,255,0.8);"> \
               </i>&nbsp;: ' + name + ' ID: ' + id + '  Email: ' + email + ' &nbsp;</h4>'

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

function Function_info(x) {

    id_heartbeat.text(bigdata[x]["nhip_tim"]);

    id_oxy.text(bigdata[x]["oxy"]);

    id_blood_pressure.text(bigdata[x]["huyet_ap"]);

    id_body_temp.text(bigdata[x]["nhiet_do"]);

    id_tall.text(bigdata[x]["chieu_cao"]);

    id_weight.text(bigdata[x]["can_nang"]);

    id_old.text(bigdata[x]["tuoi"]);

    id_sex.text(bigdata[x]["gioi_tinh"]);

    // show don thuoc

    id_chuandoanbenh_out.html("<strong> Chuẩn đoán bệnh : </strong> " + bigdata[x]["chuan_doan"]);

    let obj = JSON.parse(bigdata[x].don_thuoc)

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
    // console.log(data);

    let html = "";

    for (x = 0; x < data.length; x++) {
        html = html + '<a class= btn btn-light  onclick=Function_info(' + x + ')>' + data[x]["date"] + ' - ' + data[x]["chuan_doan"] + '</a>';
    }

    var html_1 = '<div data-spy=scroll data-target=#myScrollspy style= " height:400px ; overflow-y: scroll ">';

    var html_2 = '</div>';

    return html_1 + html + html_2;
}

// ===============================================================================
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

// ===================================================================================

// func_so_kham_benh
//  hiển thị danh sách khám bệnh của bệnh nhân
//  cấu trúc  [00/11/0000 : triệu chứng , chuẩn đoán , điều trị ]
