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

var numb = [];

var list_data = [];

var from_list_id = $("#from-list-id");

var id_user = $("#iduser");

let index_id_user ;

function html_div_from_list_id(x, n) {

    x = x + 1;

    var div_from_html =
    '<div id="id_' + String(x) + '" class="form-row"> \
    <div class="form-group col-md"> \
    <input type="text" class="form-control" id="nhap_ten_thuoc_'+ String(x) + '"  value="' + String(n) + '"  disabled>\
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

// --------------------------- function -----------------------------
// ------------------------------------------------------------------

function set_list_data(x, n) {
    list_data[x] = {
        id: n
    };
};

// ------------------------------------------------------------------
function Func_ADD() {

    let n = id_user.val();

    if (n != "") {
        for (let x = 0; x < 100; x++) {
            if (n === list_data[x].id) {
                alert("id đã có trong danh sách")
                break;
            }

            if (numb[x] == 0) {
                numb[x] = 1;
                // ADD id xuống dưới và hiển thị
                from_list_id.append(html_div_from_list_id(x, n));
                // ghi data id vao bang
                set_list_data(x, n);
                // log
                console.log(x, n);
                break;
            }

        }

        // clean các value trong from input
        id_user.val("");

    } else {
        $('#modal_check_ADD').modal('show');
    };
};
// ------------------------------------------------------------------
function Func_DELETE(x) {

    console.log("X = " +x);

    if (numb[x - 1] == 1) {
        numb[x - 1] = 0;

        $("#id_" + String(x)).remove();

        x = x - 1

        list_data[x].id = null;

        for(x = 0 ; x <10 ;x++ )
        {
            console.log(list_data[x].id);
        }

    }
};
// ------------------------------------------------------------------
function Func_DELETE_ALL() {
    $('#modal_check_F_OUT').modal('show');
};
function modal_Func_DELETE_ALL() {
    $('#modal_check_F_OUT').modal('hide');
    console.log("OUT");
    for (let x = 0; x < 100; x++) {
        numb[x] = 0;
        list_data[x]["id"] = null;
    }
    from_list_id.empty();
};

// ------------------------------------------------------------------
//  gửi data về server
function Func_Save() {
    //Bắt sự kiện nhap nut
    $('#modal_check_F_IN').modal('show');
};
function modal_Func_Save() {
    $('#modal_check_F_IN').modal('hide');

    y = 0;

    let json = {
        "id" : index_id_user,
        "list" :[]
    }

    for (x = 0; x < 10; x++)
    {
        if (list_data[x].id != null )
        {
            json["list"][y] = list_data[x].id;
            y = y+1;
        }
    }

    // let obj = JSON.parse(list_data);
    // console.log(obj);

    // gửi data về server / POST

    $.ajax({
        async: false,
        type: "POST",
        url: "/postsavelistid",
        data: json,
        dataType: 'json',
    }).done(function (data) {
        // log data
        console.log(data.user_enable);
    });

};

// ------------------------------------------------------------------
//Hàm đọc giá trị và hiện thị thông tin
function textthaydoi() {
    var value = $(this).val();
    console.log(value);
}

// ------------------------------- main -----------------------------
// ------------------------------------------------------------------

$(document).ready(function () {

    // ============================================================
    console.log("<!- START -!> ");
    // ============================================================
    // tạo 1 list data rỗng
    for (let x = 0; x < 100; x++) {
        set_list_data(x,null)
        numb[x] = 0;
    }
    // ============================================================

    $.ajax({
        async: false,
        type: "GET",
        url: "/getuserlogin",
        data: 'json',
        dataType: 'json',
    }).done(function (data_get) {

        console.log(data_get["id"]);

        index_id_user = data_get["id"];

        let obj = JSON.parse(data_get["user_enable"]);

        // console.log(obj["list"].length);

        for (x = 0; x < obj["list"].length; x++) {

            // console.log(obj[x]);
            if (numb[x] == 0 ) {
                numb[x] = 1;
                // ADD thuốc xuống dưới và hiển thị
                from_list_id.append(html_div_from_list_id(x, obj["list"][x]));
                // ghi data id vao bang
                set_list_data(x, obj["list"][x]);
                // log
                console.log(x, obj["list"][x]);
            }
        }

    }).fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
});
// ------------------------------------------------------------------
