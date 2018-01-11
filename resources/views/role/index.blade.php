@extends('layout.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">角色列表</h3>
                    </div>
                    <a type="button" class="btn " href="/roles/create" >增加角色</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th>角色名称</th>
                                <th>描述</th>
                                <th>操作</th>
                            </tr>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->id}}.</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->description}}</td>
                                    <td>
                                        <a type="button" class="btn" href="/roles/{{$role->id}}/edit" >编辑</a>
                                        <a type="button" class="btn resource-delete" delete-url="/roles/{{$role->id}}" href="#" >删除</a>
                                        <a type="button" class="btn" href="/roles/{{$role->id}}/permission" >权限管理</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                   {{$roles->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection