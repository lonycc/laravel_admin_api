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
                        <h3 class="box-title">编辑稿件</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="/news/{{$news->id}}" method="POST">
                        {{method_field('put')}}
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">标题</label>
                                <input type="text" class="form-control" name="title" placeholder="请输入标题" value="{{$news->title}}" />
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="keywords">关键词</label>
                                <input type="text" class="form-control" name="keywords" placeholder="关键词, 多个用逗号分开" value="{{$news->keywords}}" />
                            </div>
                        </div>
                            
                        <div class="box-body">
                            <div class="form-group">
                                <div class="select">
                                    <label for="channel_id">所属栏目</label>
                                    <select name="channel_id" class="form-control">
                                        <option value="">请选择栏目</option>
                                        @foreach($channels as $channel)
                                        <option value="{{$channel->id}}"
                                        @if($channel->id == $news->channel_id)
                                        selected
                                        @endif
                                        >{{$channel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
    
                        <div class="box-body">
                            <div class="form-group">
                                <label for="content">正文内容</label>
                                <textarea id="content" style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="正文内容">{{$news->content}}</textarea>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="hot">设为热门</label>
                                <input type="radio" name="hot" value="1" @if($news->hot === 1) checked @endif /><label>是</label>
                                <input type="radio" name="hot" value="0" @if($news->hot === 0) checked @endif /><label>否</label>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="status">状态</label>
                                <input type="radio" name="status" value="1" @if($news->status === 1) checked @endif /><label>正常</label>
                                <input type="radio" name="status" value="0" @if($news->status === 0) checked @endif /><label>过期</label>
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