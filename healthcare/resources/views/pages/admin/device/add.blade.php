@extends('pages.admin.layout.index')

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Device
                    <small>Add</small>
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
        
                <form action="admin/device/add" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    
                    <div class="form-group">
                        <label> ID device </label>
                        <input class="form-control" name="txtIDdevice" placeholder="Please Enter ID Device" />
                    </div>


                    <button type="submit" class="btn btn-default">User Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>

                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection