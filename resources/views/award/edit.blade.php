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
                        <h3 class="box-title">编辑奖项</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="/award/{{$award->id}}" method="POST">
                        {{method_field('put')}}
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="lottery_id">所属项目</label>
                                <select class="form-control" name="lottery_id">
                                        <option value="">请选择所属项目</option>
                                        @foreach($lotterys as $lottery)
                                        <option value="{{$lottery->id}}"
                                        @if($lottery->id == $award->lottery_id)
                                        selected
                                        @endif
                                        >{{$lottery->name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">奖项名</label>
                                <input type="text" class="form-control" name="name" value="{{$award->name}}" />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="info">描述</label>
                                <input type="text" class="form-control" name="info" value="{{$award->info}}" />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="score">中奖数</label>
                                <input type="number" class="form-control" name="score" value="{{$award->score}}" />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="rank">抽奖顺序</label>
                                <input type="number" class="form-control" name="rank" value="{{$award->rank}}" />
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