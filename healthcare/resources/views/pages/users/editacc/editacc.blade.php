<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Edit Account</title>
    <link rel="stylesheet" href="user_asset/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="user_asset/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="user_asset/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="user_asset/assets/fonts/typicons.min.css">
    <link rel="stylesheet" href="user_asset/assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="user_asset/assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="user_asset/assets/css/Header-Blue.css">
    <link rel="stylesheet" href="user_asset/assets/css/Highlight-Blue.css">
    <link rel="stylesheet" href="user_asset/assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="user_asset/assets/css/styles.css">
    <link rel="stylesheet" href="user_asset/assets/css/Team-Boxed.css">
    <link rel="stylesheet" href="user_asset/css/login-style.css">
    <link rel="stylesheet" href="user_asset/assets/css/EditAcc.css">
</head>

<body>

    @include('pages.users.layout.header')


    {{-- <form> --}}

      <div class="container" style="padding-left: 200px; padding-right: 200px;">
        <h3>Thông tin tài khoản :</h3>
        <p> Nếu bạn chỉ muốn thay đổi mật khẩu , hãy để trống Họ tên / Hardware   </p>
        <hr>
        <label id="get_name" for="name"><b>Họ tên</b></label>
        <input id="name" type="text" placeholder="Nhập tên mới" name="name" required>

        <!-- <label id="get_email" for="email"><b>Email</b></label>
        <input id="email" type="text" placeholder="Nhập email mới" name="email" required> -->

        <label id="get_idhw" for="idhw"><b>Hardware</b></label>
        <input id="idhw" type="text" placeholder="Nhập id Hardware mới" name="idhw" required>

        <label for="psw-new"><b>Mật khẩu mới</b></label>
        <input id="psw-new" type="password" placeholder="Enter Password" name="psw" required>

        <label for="psw-repeat"><b>Nhập lại mật khẩu</b></label>
        <input id="psw-repeat" type="password" placeholder="Repeat Password" name="psw-repeat" required>

        <div >
            <button id="save" class="btn btn-primary btn-block">Lưu thay đổi</button>
        </div>

      </div>

{{-- </form> --}}



  <script src="user_asset/assets/js/jquery.min.js"></script>
  <script src="user_asset/assets/js/jquery.cookie.js"></script>
  <script src="user_asset/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="user_asset/assets/js/editacc.js"></script>
</body>

</html>
