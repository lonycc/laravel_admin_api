@extends('layout.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">操作日志列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10%">id</th>
                                <th>操作帐号</th>
                                <th>方法</th>
                                <th>路径</th>
                                <th>ip</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{$log->id}}.</td>
                                    <td>{{$log->user}}</td>
                                    <td>{{$log->method}}</td>
                                    <td>{{$log->path}}</td>
                                    <td>{{$log->ip}}</td>
                                    <td>{{$log->created_at}}</td>
                                    <td>
                                        <a type="button" class="btn resource-delete" delete-url="{{route('logs.destroy', ['log'=>$log->id])}}" href="#">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{$logs->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
