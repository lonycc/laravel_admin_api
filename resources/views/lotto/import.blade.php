@extends('layout.main')
@section('content')
        <!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-10 col-xs-6">
            <div class="box">

                <!-- /.box-header -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">导入数据</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="/lotto/{{$lotto->id}}/import" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="xls">上传xls文件</label>
                                <input type="file" class="form-control" name="xls" required />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="start">从第几行开始[默认去表头]</label>
                                <input type="number" class="form-control" name="start" value="2" required disabled />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="main">第几列作为抽奖列</label>
                                <input type="number" class="form-control" name="main" value="1" required />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="lotto"></label>
                                <input type="hidden" class="form-control" name="lotto" value="{{$lotto->id}}" />
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