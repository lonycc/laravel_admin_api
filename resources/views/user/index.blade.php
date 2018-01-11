@extends('layout.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">用户列表</h3>
                    </div>
                    <a type="button" class="btn " href="/users/create" >添加用户</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th>用户</th>
                                <th>操作</th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}.</td>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        <a type="button" class="btn" href="/users/{{$user->id}}/edit" >编辑</a>
                                        @if(\Auth::id() != $user->id)
                                            <a type="button" class="btn resource-delete" delete-url="/users/{{$user->id}}" href="#" >删除</a>
                                        @endif
                                        <a type="button" class="btn" href="/users/{{$user->id}}/role" >角色管理</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection