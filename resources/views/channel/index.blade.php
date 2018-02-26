@extends('layout.main')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">栏目列表</h3>
                    </div>
                    <a type="button" class="btn" href="{{route('channels.create')}}">添加栏目</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10%">id</th>
                                <th>栏目名</th>
                                <th>父栏目</th>
                                <th>操作</th>
                            </tr>
                            @foreach($channels as $channel)
                                <tr>
                                    <td>{{$channel->id}}.</td>
                                    <td><a href="{{route('channels.news', ['channel'=>$channel->id])}}">{{$channel->name}}</a></td>
                                    
                                    @if($channel->pid == 0)
                                    <td>/</td>
                                    @else
                                    <td>{{$channel->parent->name}}</td>
                                    @endif
                                    <td>
                                        <a type="button" class="btn" href="{{route('channels.edit', ['channel'=>$channel->id])}}">编辑</a>
                                        <a type="button" class="btn resource-delete" delete-url="{{route('channels.destroy', ['channel'=>$channel->id])}}" href="#">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{$channels->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
