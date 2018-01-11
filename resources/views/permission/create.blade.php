@extends('layout.main')
@section('content')
        <!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-10 col-xs-6">
            <div class="box">

                <!-- /.box-header -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">增加权限</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="/permissions" method="POST">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label >权限名</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>父节点</label>
                                <select class="form-control select2" style="width: 100%;" name="parent_id">
                                    <option selected="selected" value="0">/</option>
                                    @foreach($parents as $parent)
                                        <option value="{{$parent->id}}">{{$parent->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >命名空间</label>
                                <input type="text" class="form-control" name="namespace">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >控制器</label>
                                <input type="text" class="form-control" name="controller">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >方法名</label>
                                <input type="text" class="form-control" name="action">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >样式</label>
                                <input type="text" class="form-control" name="class">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>描述</label>
                                <input type="text" class="form-control" name="description">
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