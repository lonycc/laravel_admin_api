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
                        <h3 class="box-title">添加应用</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('apps.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">名称</label>
                                <input type="text" class="form-control" name="name" placeholder="应用名称" />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="info">简介</label>
                                <input type="text" class="form-control" name="info" placeholder="应用简介" />
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="logo">logo</label>
                                <input type="file" class="form-control" name="logo" placeholder="应用logo" />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="url">url</label>
                                <input type="text" name="url" class="form-control" placeholder="应用链接地址" />
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