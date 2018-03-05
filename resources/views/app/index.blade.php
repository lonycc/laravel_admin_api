@extends('layout.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">应用列表</h3>
                    </div>
                    <a type="button" class="btn" href="{{route('apps.create')}}">添加应用</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10%">id</th>
                                <th>名称</th>
                                <th>简介</th>
                                <th>logo</th>
                                <th>url</th>
                                <th>操作</th>
                            </tr>
                            @foreach($apps as $app)
                                <tr>
                                    <td>{{$app->id}}.</td>
                                    <td>{{$app->name}}</td>
                                    <td>{{$app->info}}</td>
                                    <td>@if($app->logo) <img src="{{$app->logo}}" width="64" height="64" /> @endif</td>
                                    <td><a target="__blank" href="{{$app->url}}">{{$app->url}}</a></td>
                                    <td>
                                        <a type="button" class="btn" href="{{route('apps.edit', ['app'=>$app->id])}}">编辑</a>
                                        <a type="button" class="btn resource-delete" delete-url="{{route('apps.destroy', ['app'=>$app->id])}}" href="#">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{$apps->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
