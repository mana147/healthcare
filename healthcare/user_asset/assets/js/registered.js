console.log("check key ok ");

var id_save = $("#save");

var id_txtUser = $("#txtUser");
var id_txtEmail = $("#txtEmail");
var id_txtPass = $("#txtPass");
var id_number = $("#number");
var id_inputState = $("#inputState");

var wsUri = "ws://localhost:443";
var output;


$(document).ready(function () {
    id_save.click(function () {

        let obj = {
            name: id_txtUser.val(),
            email: id_txtEmail.val(),
            pass: id_txtPass.val(),
            number: id_number.val(),
            option: id_inputState.val(),
        }

        if (obj.name != '' && obj.email != '' && obj.pass != '')
        {
            var myJSON = JSON.stringify(obj);
            $.cookie('registered', myJSON, { expires: 1 });
            // console.log(myJSON);
        }
    });

});



