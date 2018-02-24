@extends('layout.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">数据集列表</h3>
                    </div>
                    <a type="button" class="btn" href="/lotto/create">添加数据集</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th>数据集名</th>
                                <th>说明</th>
                                <th>操作</th>
                            </tr>
                            @foreach($lottos as $lotto)
                                <tr>
                                    <td>{{$lotto->id}}.</td>
                                    <td>{{$lotto->name}}</td>
                                    <td>{{$lotto->info}}</td>
                                    <td>
                                        <a type="button" class="btn" href="/lotto/{{$lotto->id}}/edit" >编辑</a>
                                        <a type="button" class="btn resource-delete" delete-url="/lotto/{{$lotto->id}}" href="#" >删除</a>
                                        <a type="button" class="btn" href="/lotto/{{$lotto->id}}/data" >数据</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{$lottos->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
