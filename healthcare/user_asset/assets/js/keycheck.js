
let data = $.cookie('registered');
var id_randomkey = $("#randomkey");
var id_key_check = $("#key");
var id_bt_check = $("#bt-check");
var id_show_mail_check = $("#show_mail_check");
var id_token = $("#_token");

$(document).ready(function () {
    let json_data = JSON.parse(data);
    id_show_mail_check.html(json_data['email']);

    // console.log(json_data);
    // console.log(id_token.val());

    json_data['_token'] = id_token.val();

    
    id_bt_check.click(function () {

        // console.log(id_randomkey.html());
        // console.log(id_key_check.val());
        // console.log(json_data);

        if (id_randomkey.html() === id_key_check.val()) {

            $.ajax({
                async: true,
                type: "POST",
                url: "/registercheck",
                data: json_data ,
                dataType: 'json',
            }).done(function (data) {
                console.log(data);
                alert("kích hoạt thành công");
                location.replace("/");
            });


        } else {
            alert('key kích hoạt sai');
        }
    });
    
});