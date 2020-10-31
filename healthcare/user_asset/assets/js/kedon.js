// viết chức năng render from-kedon cho site kê đơn thuốc
// Func_ADD : kích button ADD hiển thị thêm khung from cho phép người nhập
// Func_DELETE : kích button DELETE xóa khung nhập
// Func_IN : lấy toàn hộ thông tin vừa nhập trên các from đưa ra bảng biểu
//
// Func_OUT : xóa toàn bộ khung from
// check thong tin cua from : khi nao du thong tin moi dc add

// Tên thuốc không đc chùng nhau . (done)
// xóa hết thông tin ở phần ADD sau khi ấn nút ADD (done)
// nếu from ADD = null thì thông báo lỗi và không cho ADD xuống dưới  (done)
// hiển thị UX/UI hiển thị đơn thuốc sang 1 site mới  (done)
// và hỗ trọ máy in


// ----------------- value ---------------
var key = true;

var numb = [100];

var list_data = [100];

var id_from_kedon = $("#from-kedon");
var id_kedonxong = $("#kedonxong");
var id_list_data_thuoc = $("#list_data_thuoc");

var id_ten_thuoc = $("#ten_thuoc");
var id_don_vi_thuoc = $("#don_vi_thuoc");
var id_so_luong_thuoc = $("#so_luong_thuoc");
var id_lieu_dung_thuoc = $("#lieu_dung_thuoc");

var id_chuandoanbenh = $('#chuandoanbenh');
var id_chuandoanbenh_out = $('#chuandoanbenh_out');


// ------------------- main ----------------

$(document).ready(function () {

    // from site Home - Healthcare
    // User id_userhw and is_index
    let id_userhw = $.cookie('id_userhw');
    let id_index = $.cookie('id');

    console.log(id_index +"/"+id_userhw);

    // tạo 1 list data rỗng
    for (let x = 0; x < 100; x++) {
        set_list_data(x,'', '', '', '')
        numb[x] = 0;
    }
});
// ------------------- ----------------


// function change_id (x) {
//     var str_ten_thuoc = "#ten_thuoc_"+x;
//     var str_don_vi_thuoc = "#don_vi_thuoc_"+x;
//     var str_so_luong_thuoc = "#so_luong_thuoc_"+x;
//     var str_lieu_dung_thuoc = "#lieu_dung_thuoc_"+x;
//     var id_ten_thuoc_0 = $(str_ten_thuoc);
//     var id_don_vi_thuoc_0 = $(str_don_vi_thuoc);
//     var id_so_luong_thuoc_0 = $(str_so_luong_thuoc);
//     var id_lieu_dung_thuoc_0 = $(str_lieu_dung_thuoc);
// };


// function get_value_change_id(x) {
//     var id_ten_thuoc = $("#ten_thuoc_" + x);
//     var id_don_vi_thuoc = $("#don_vi_thuoc_" + x);
//     var id_so_luong_thuoc = $("#so_luong_thuoc_" + x);
//     var id_lieu_dung_thuoc = $("#lieu_dung_thuoc_" + x);
//     return (id_ten_thuoc.val() + id_don_vi_thuoc.val() + id_so_luong_thuoc.val() + id_lieu_dung_thuoc.val())
// }


function html_div_from_kedon(x, n, dv, sl, ld) {

    x = x + 1;
    var div_from_html = '<div id="kedon_' + String(x) + '" class="form-row"> \
    <div class="form-group col-md-5"> \
    <input type="text" class="form-control" id="nhap_ten_thuoc_'+ String(x) + '"  placeholder="Nhập tên thuốc:" value="' + String(n) + '"  disabled>\
    </div> \
    <div class="form-group col-md-1">\
    <input type="text" class="form-control" id="don_vi_thuoc_'+ String(x) + '" placeholder="ĐV:" value="' + String(dv) + '" disabled> \
    </div> \
    <div class="form-group col-md-1">\
    <input type="text" class="form-control" id="so_luong_thuoc_'+ String(x) + '" placeholder="SL:" value="' + String(sl) + '" disabled> \
    </div> \
    <div class="form-group col-md-4">\
    <input type="text" class="form-control" id="lieu_dung_thuoc_'+ String(x) + '" placeholder="Liều dùng:" value="' + String(ld) + '" disabled> \
    </div> \
    <div class="form-group"> \
    <button type="button" class="btn btn-outline-danger" onclick="Func_DELETE('+ String(x) + ')">DELETE </button> \
    </div>\
    </div> ';

    return String(div_from_html);
};

function html_div_list_data_thuoc(n, dv, sl, ld) {
    var div_list_html = '<tr>\
    <td>'+ String(n) + '<br></td>\
    <td>'+ String(dv) + '</td>\
    <td>'+ Number(sl) + '</td>\
    <td>'+ String(ld) + '&nbsp;</td>\
    </tr>\ ';

    return String(div_list_html)
};

function creat_donthuoc(n, dv, sl, ld)
{
    let data = {
        list :[
        ]
    }
}

// ---------------- function ---------------
function set_list_data(x, n, dv, sl, ld) {
    list_data[x] = {
        tenthuoc: String(n),
        donvi: String(dv),
        soluong: Number(sl),
        lieudung: String(ld)
    };
};
// -----------------------------------------
function Func_ADD() {

    let n = id_ten_thuoc.val();
    let dv = id_don_vi_thuoc.val();
    let sl = id_so_luong_thuoc.val();
    let ld = id_lieu_dung_thuoc.val();

    if (n !="") // kiểm tra xem tên thuốc có void không
    {
        for (let x = 0; x < 100; x++)
        {
            // console.log(list_data[x]);
            if ( String (n) === list_data[x]["tenthuoc"])
            {
                console.log("ten thuoc trung nhau");
                break;
            }

            if (numb[x] == 0)  {
                numb[x] = 1;

                // ADD thuốc xuống dưới và hiển thị
                id_from_kedon.append(html_div_from_kedon(x, n, dv, sl, ld));
                // ghi data thuốc vào bảng
                set_list_data(x, n, dv, sl, ld);
                // log
                console.log(x, n);
                break;
            }

        }


        // clean các value trong from input
        id_ten_thuoc.val("");
        id_don_vi_thuoc.val("");
        id_so_luong_thuoc.val("");
        id_lieu_dung_thuoc.val("");


    } else {
        $('#modal_check_ADD').modal('show');
    };
};
// -----------------------------------------
function Func_DELETE(x) {
    if (numb[x - 1] == 1) {
        numb[x - 1] = 0;
        $("#kedon_" + String(x)).remove();
        list_data[x] = null;
        console.log("DELETE", x);
    }
};
// -----------------------------------------
function Func_DELETE_ALL() {
    $('#modal_check_F_OUT').modal('show');
};
function modal_Func_DELETE_ALL() {
    $('#modal_check_F_OUT').modal('hide');
    console.log("OUT");
    for (let x = 0; x < 100; x++)
    {
        numb[x] = 0;
        list_data[x].tenthuoc = null;
    }
    id_from_kedon.empty();
};

// ------------------------------------------------------------------

function Func_SAVE() {
    //Bắt sự kiện nhap nut
    if (key == true) {
        $('#modal_check_F_IN').modal('show');
    }
};

function modal_Func_SAVE()
{
    $('#modal_check_F_IN').modal('hide');

    id_chuandoanbenh_out.html("<strong> Chuẩn đoán bệnh : </strong> "+ id_chuandoanbenh.val() );

    // tạo cấu trúc data gửi về server
    let data = {
        list :[
        ]
    }

    for (let x = 0; x < 100; x++)
    {
        // console.log(list_data[x]);
        if (list_data[x]["tenthuoc"] != "")
        {
            // show đơn thuốc
            id_kedonxong.fadeIn();

            let n = list_data[x]["tenthuoc"];
            let dv = list_data[x]["donvi"];
            let sl = list_data[x]["soluong"];
            let ld = list_data[x]["lieudung"];

            // ghi và hiển thị bảng đơn thuốc
            id_list_data_thuoc.append(html_div_list_data_thuoc(n, dv, sl, ld));

            data.list[x] = {
                dv : list_data[x]["donvi"],
                ld : list_data[x]["lieudung"],
                sl :list_data[x]["soluong"],
                name : list_data[x]["tenthuoc"],
            }

            key = false;
        }
    }

    console.log(data);


};

