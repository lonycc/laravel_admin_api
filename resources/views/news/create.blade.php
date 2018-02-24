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
                        <h3 class="box-title">添加稿件</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="/news" method="POST">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">标题</label>
                                <input type="text" class="form-control" name="title" placeholder="请输入标题" />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="keywords">关键词</label>
                                <input type="text" class="form-control" name="keywords" placeholder="关键词, 多个用逗号分开" />
                            </div>
                        </div>
                        
                        <div class="box-body">
                            <div class="form-group">
                                <div class="select">
                                    <label for="channel_id">所属栏目</label>
                                    <select name="channel_id" class="form-control">
                                        <option value="">请选择栏目</option>
                                        @foreach($channels as $channel)
                                        <option value="{{$channel->id}}">{{$channel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="content">正文内容</label>
                                <textarea id="content" style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="正文内容"></textarea>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="hot">设为热门</label>
                                <input type="radio" name="hot" value="1" /><label>是</label>
                                <input type="radio" name="hot" value="0" checked /><label>否</label>
                            </div>
                        </div>
    
                        <div class="box-body">
                            <div class="form-group">
                                <label for="status">状态</label>
                                <input type="radio" name="status" value="1" checked /><label>正常</label>
                                <input type="radio" name="status" value="0" /><label>过期</label>
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