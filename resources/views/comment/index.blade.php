@extends('layout.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">评论列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10%">id</th>
                                <th>用户</th>
                                <th>日期</th>
                                <th>状态</th>
                                <th>评论内容</th>
                                <th>稿件标题</th>
                                <th>操作</th>
                            </tr>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{$comment->id}}.</td>
                                    <td>{{$comment->create_user}}</td>
                                    <td>{{$comment->created_at}}</td>
                                    <td>@if($comment->status===1) 正常 @else 禁用 @endif</td>
                                    <td>{{$comment->content}}</td>
                                    <td>{{$comment->news->title}}</td>
                                    <td>
                                        <a type="button" class="btn" href="{{route('comments.edit', ['comment'=>$comment->id])}}">编辑</a>
                                        <a type="button" class="btn resource-delete" delete-url="{{route('comments.destroy', ['comment'=>$comment->id])}}" href="#">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{$comments->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
