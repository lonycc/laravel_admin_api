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
                        <h3 class="box-title">添加栏目</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="/channel" method="POST">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">栏目名</label>
                                <input type="text" class="form-control" name="name" placeholder="栏目名" />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="select">
                                    <label for="pid">父栏目</label>
                                    <select name="pid" class="form-control">
                                        <option value="0">/</option>
                                        @foreach($channels as $channel)
                                        <option value="{{$channel->id}}">{{$channel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
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