<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Healthcare</title>
    <base href="{{asset('')}}">
    <!-- Import Bootstrap css, js, font awesome here -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->

    <!-- <link href="user_asset/css/login-style.css" rel="stylesheet"> -->
	<!-- <script type="text/javascript" src="user_asset/js/login.js" ></script> -->

    <!-- font google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="user_asset/assets/bootstrap/css/bootstrap.min.css">
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

</head>
<body>
    <!-- Navigation -->
    @include('pages.users.layout.header')

    @yield('content')

</body>
</html>
