@extends('layout.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">数据列表</h3>
                    </div>
                    <a type="button" class="btn" href="{{route('lottos.import', ['lotto'=>$lotto->id])}}">导入数据</a>
                    <a type="button" class="btn resource-delete" delete-url="{{route('data.destroy', ['lotto'=>$lotto->id])}}" href="#">删除</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th>抽奖列</th>
                                <th>辅助列</th>
                            </tr>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{$data->id}}.</td>
                                    <td>{{$data->main}}</td>
                                    <td>{{$data->other}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{$datas->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
