@extends('pages.admin.layout.index')

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Device
                    <small>List device</small>
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
                        <th>ID index</th>
                        <th>ID device</th>
                        <th>Status</th>
                        
                        <th>nhip_tim</th>
                        <th>oxy</th>
                        <th>huyet_ap</th>
                        <th>nhiet_do</th>
                        
                        <th>Delete</th>
                        {{-- <th>Edit</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devices as $device )
                        <tr class="odd gradeX" align="center">
                            <td>{{$device->id}}</td>
                            <td>{{$device->id_device}}</td>
                            <td>{{$device->status}}</td>

                            <td>{{$device->nhip_tim}}</td>
                            <td>{{$device->oxy}}</td>
                            <td>{{$device->huyet_ap}}</td>
                            <td>{{$device->nhiet_do}}</td>

                            <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="admin/device/delete/{{$device->id}}"> Delete</a></td>
                            {{-- <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/device/edit/{{$device->id}}">Edit</a></td> --}}
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

