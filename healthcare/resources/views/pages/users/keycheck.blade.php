<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>home</title>
    <base href="{{asset('')}}">
    <!-- Import Bootstrap css, js, font awesome here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">       
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <link href="user_asset/css/login-style.css" rel="stylesheet">
    
</head>
<body>
<!-- Navigation -->
<nav id="navbar_header" class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid">
		<a class="navbar-branch" href="">
			<img src="user_asset/images/logo.png" height="35">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" 
			data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link active" href="login">Login</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="login-page">
    <div class="form">
        {{-- <form class="login-form" action="#" method="POST"> --}}
            <input id="_token" type="hidden" name="_token" value="{{csrf_token()}}"/>

            <div class="form-group" > 
                <p> Vui lòng nhập key gửi về mail <br> Để kích hoạt tài khoản  </p>
            </div>

            <div id="show_mail_check" class="form-group" > 
            
            </div>
            
            <div class="form-group">
                <input type="text" class="form-control" id="key" placeholder="Enter key active" name="key">
            </div>
            <button id="bt-check" type="submit" class="btn btn-primary">Check key </button>
        {{--</form> --}}
    </div>
</div>

<p hidden id="randomkey">{{$key}}</p>

<script src="user_asset/assets/js/jquery.cookie.js"></script>
<script src="user_asset/assets/js/keycheck.js"> </script>

</body>
</html>