//
var id_name = $("#name");
var id_email = $("#email");
var id_idhw = $("#idhw");
var id_psw_new = $("#psw-new");
var id_psw_repeat = $("#psw-repeat");

var id_get_name = $("#get_name");
var id_get_email = $("#get_email");
var id_get_idhw = $("#get_idhw");

var id_save = $("#save");

var data_user;

// ==========================================================
// ============================ MAIN ========================
// ==========================================================

$(document).ready(function () {

    // ==========================================================
    console.log("<!- START -!> ");

    // ==========================================================
    //  lấy thông tin người dùng hiện tại

    $.ajax({
        async: false,
        type: "GET",
        url: "/getuserlogin",
        data: 'json',
        dataType: 'json',
    }).done(function (data_get) {

        // console.log(data_get);

        id_get_name.html('<b>Họ tên : ' + data_get.name + ' / Email : ' + data_get.email + ' </b>');

        id_get_email.html('<b>Email : ' + data_get.email + ' </b>');

        id_get_idhw.html('<b>Hardware : ' + data_get.id_userhw + ' </b>');

        data_user = data_get;

    }).fail(function (jqXHR, textStatus, errorThrown) {

        console.log(textStatus + ': ' + errorThrown);

    });

    // ==========================================================
    id_save.click(function () {

        let n = id_name.val();
        let e = id_email.val();
        let h = id_idhw.val();
        let pn = id_psw_new.val();
        let pr = id_psw_repeat.val();

        let json = {
            id: data_user.id,
            name: "",
            email: "",
            idhw: "",
            pass: ""
        }
        // ===================================
        if (n == "") {
            json.name = data_user.name;
        } else {
            json.name = n;
        }
        // ===================================
        if (e == "") {
            json.email = data_user.email;
        } else {
            json.email = e;
        }
        // ===================================
        if (h == "") {
            json.idhw = data_user.id_userhw;
        } else {
            json.idhw = h;
        }
        // ===================================

        if (pn == "" || pr == "") {
            alert("Vui lòng nhập mật khẩu !");
        } else if (pr != pn) {
            alert("Nhập lại mật khẩu không đúng");
        } else if (String(pr).length < 5) {
            alert("Mật khẩu quá ngắn");
        } else {
            json.pass = pr;
            // console.log(json);
            $.ajax({
                async: false,
                type: "POST",
                url: "/posteditacc",
                data: json,
                dataType: 'json',
            }).done(function (data) {
                // log data
                alert('cập nhật thông tin người dùng thành công');
                // console.log(data);
                location.reload();
            }).fail(function (jqXHR, textStatus, errorThrown) {
                // If fail
                alert('cập nhật thất bại , kiểm tra kết nối internet');
                console.log( jqXHR + textStatus + ': ' + errorThrown);
            });

        }
    });


    // ==========================================================

});
// ==========================================================
// ==========================================================
// ==========================================================
