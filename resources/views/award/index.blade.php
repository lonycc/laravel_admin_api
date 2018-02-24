@extends('layout.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">奖项列表</h3>
                    </div>
                    <a type="button" class="btn" href="/award/create">添加奖项</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th>名称</th>
                                <th>说明</th>
                                <th>中奖数</th>
                                <th>抽奖顺序</th>
                                <th>操作</th>
                            </tr>
                            @foreach($awards as $award)
                                <tr>
                                    <td>{{$award->id}}.</td>
                                    <td>{{$award->name}}</td>
                                    <td>{{$award->info}}</td>
                                    <td>{{$award->score}}</td>
                                    <td>{{$award->rank}}</td>
                                    <td>
                                        <a type="button" class="btn" href="/award/{{$award->id}}/edit" >编辑</a>
                                        <a type="button" class="btn resource-delete" delete-url="/award/{{$award->id}}" href="#" >删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
