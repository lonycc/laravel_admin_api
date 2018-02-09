@extends('layout.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">项目列表</h3>
                    </div>
                    <a type="button" class="btn " href="/lottery/create" >添加项目</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th>项目名</th>
                                <th>说明</th>
                                <th>操作</th>
                            </tr>
                            @foreach($lotterys as $lottery)
                                <tr>
                                    <td>{{$lottery->id}}.</td>
                                    <td>{{$lottery->name}}</td>
                                    <td>{{$lottery->info}}</td>
                                    <td>
                                        <a type="button" class="btn" href="/lottery/{{$lottery->id}}/edit" >编辑</a>
                                        <a type="button" class="btn resource-delete" delete-url="/lottery/{{$lottery->id}}" href="#" >删除</a>
                                        <a type="button" class="btn" href="/lottery/{{$lottery->id}}/award" >奖项</a>
                                        <a type="button" class="btn" href="/lottery/{{$lottery->id}}/lotto" >数据集</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{$lotterys->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
