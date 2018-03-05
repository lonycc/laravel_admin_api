@extends('layout.main')
@section('content')
        <!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-10">
            <div class="box">

                <!-- /.box-header -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">稿件详情</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <h2 class="news-title">{{$news->title}}</h2>
                        <p class="news-meta">创建时间: {{$news->created_at->toFormattedDateString()}}  点击数: {{$news->hits}}</p>
                        <p class="news-keywords">关键词: {{$news->keywords}}</p>
                        <div class="news-content">
                            {!! $news->content !!}
                        </div>
                    </div>

                    <div class="box-body">
                        <p>用户点击列表：
                            @foreach($users as $user)
                            {{$user->realname}}、
                            @endforeach
                        </p>
                    </div>
                    {{$comments->links()}}

                    <div class="box-body">
                        <p>评论列表：</p>
                        <ul>
                            @foreach($comments as $comment)
                            <li>{{$comment->content}}</li>
                            @endforeach
                        </ul>
                    </div>
                    {{$comments->links()}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection