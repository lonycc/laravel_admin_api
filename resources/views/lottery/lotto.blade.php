@extends('layout.main')
@section('content')
        <!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-10">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">关联数据集</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{route('lotterys.lotto', ['lottery'=>$lottery->id])}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="select">
                                <label for="lotto">选择数据集</label>
                                <select name="lotto" class="form-control">
                                    <option value="">请选择数据集</option>
                                    @foreach($lottos as $lotto)
                                    <option value="{{$lotto->id}}"
                                    @if($lotto->id == $lottery->lotto_id)
                                    selected
                                    @endif
                                    >{{$lotto->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </form>
                    @include('layout.error')

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
