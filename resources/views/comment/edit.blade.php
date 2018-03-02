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
                        <h3 class="box-title">编辑评论</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('comments.update', ['comment'=>$comment->id])}}" method="POST">
                        {{method_field('put')}}
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">用户</label>
                                <input type="text" class="form-control" name="name" value="{{$comment->create_user}}" disabled />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">稿件</label>
                                <input type="text" class="form-control" name="title" value="{{$comment->news->title}}" disabled />
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="content">评论内容</label>
                                <input type="text" class="form-control" name="content" value="{{$comment->content}}" disabled />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="status">状态</label>
                                <input type="radio" name="status" value="1" @if($comment->status === 1) checked @endif /><label>正常</label>
                                <input type="radio" name="status" value="0" @if($comment->status === 0) checked @endif /><label>禁用</label>
                            </div>
                        </div>                        
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                        @include('layout.error')
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection