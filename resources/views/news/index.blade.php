@extends('layout.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">稿件列表</h3>
                    </div>
                    <a type="button" class="btn " href="/news/create" >添加稿件</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10%">id</th>
                                <th>标题</th>
                                <th>点击数</th>
                                <th>是否热门</th>
                                <th>状态</th>
                                <th>发布时间</th>
                                <th>操作</th>
                            </tr>
                            @foreach($news as $article)
                                <tr>
                                    <td>{{$article->id}}.</td>
                                    <td>{{$article->title}}</td>
                                    <td>{{$article->hits}}</td>
                                    <td>{{$article->hot}}</td>
                                    <td>{{$article->status}}</td>
                                    <td>{{$article->created_at}}</td>
                                    
                                    <td>
                                        <a type="button" class="btn" href="/news/{{$article->id}}/edit" >编辑</a>
                                        <a type="button" class="btn resource-delete" delete-url="/news/{{$article->id}}" href="#" >删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{$news->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
