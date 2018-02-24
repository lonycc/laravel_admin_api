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
                    {{$news->created_at}}

                    {{$news->title}}

                    {{$news->hits}}

                    {{$news->content}}

                    {{$news->keywords}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection