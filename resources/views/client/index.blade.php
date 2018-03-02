@extends('layout.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">用户列表</h3>
                    </div>
                    <a type="button" class="btn" href="{{route('clients.create')}}">添加用户</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10%">id</th>
                                <th>用户名</th>
                                <th>邮箱</th>
                                <th>备注</th>
                                <th>用户类型</th>
                                <th>是否限定IP</th>
                                <th>允许IP</th>
                                <th>操作</th>
                            </tr>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$client->id}}.</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->realname}}</td>
                                    <td>{{$client->flag}}</td>
                                    <td>@if($client->check_ip===1) 是 @else 否 @endif</td>
                                    <td>{{$client->ip}}</td>
                                    <td>
                                        <a type="button" class="btn" href="{{route('clients.edit', ['client'=>$client->id])}}">编辑</a>
                                        <a type="button" class="btn resource-delete" delete-url="{{route('clients.destroy', ['client'=>$client->id])}}" href="#">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{$clients->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
