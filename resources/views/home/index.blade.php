@extends('layout.main')
@section('content')


<!-- Main content -->
<section class="content">
    <!-- Info boxes -->

    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">后台首页</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if (Session::has('msg'))
                    <div class="alert alert-danger">
                        <ul><li>{{ Session::get('msg') }}</li></ul>
                    </div>
                    @endif
                </div>
                <!-- ./box-body -->
                <div class="box-footer">

                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>

@endsection