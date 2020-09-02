@extends('pages.admin.layout.index')

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach

                    </div>
                @endif

                @if (session('Notify'))
                    <div class="alert alert-success">
                        {{session('Notify')}}
                    </div>
                @endif

                <form action="admin/user/edit/{{$user->id}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" name="txtUser" value="{{$user->name}}" placeholder="Please Enter New Name" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="txtPass" placeholder="Please Enter New Password" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" value = "{{$user->email}}" name="txtEmail" disabled />
                    </div>
                    <div class="form-group">
                        <label>User Level</label>
                        <label class="radio-inline">
                            <input name="rdoLevel" value="1" checked="" type="radio">Member
                        </label>
                        <label class="radio-inline">
                            <input name="rdoLevel" value="2" type="radio">Manager
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">User Edit</button>    
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection