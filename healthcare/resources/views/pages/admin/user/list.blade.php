@extends('pages.admin.layout.index')

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>List user</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                @if (session('Notify'))
                <div class="alert alert-success">
                    {{session('Notify')}}
                </div>
                @endif
                
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>ID user</th> 
                        <th>ID device</th> 
                        <th>Username</th>
                        <th>Level</th>
                        <th>Email</th>
                        {{-- <th>User enable</th> --}}

                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="odd gradeX" align="center">
                            <td>{{$user->id}}</td>
                            <td>{{$user->id_userhw}}</td>
                            <td>{{$user->id_device}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->level}}</td>
                            <td>{{$user->email}}</td>
                            {{-- <td>{{$user['user_enable']}}</td> --}}
                            {{-- <td>{{ $user['user_enable'] }}</td> --}}
                            
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/user/delete/{{$user->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/user/edit/{{$user->id}}">Edit</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection

