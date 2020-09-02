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
	<script type="text/javascript" src="user_asset/js/login.js" ></script>
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
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif

        @if (session('Notify'))
            {{session('Notify')}}
        @endif

        <form class="login-form" action="register" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="form-group">
                <input type="name" class="form-control" id="txtUser" placeholder="Enter name" name="txtUser">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="txtEmail" placeholder="Enter email" name="txtEmail">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="txtPass" placeholder="Enter password" name="txtPass">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <p class="message">Already registered? <a href="login">Sign In</a></p>
        </form>
    </div>
</div>

</body>
</html>