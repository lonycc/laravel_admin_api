@extends('layout.main')
@section('content')
        <!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-10 col-xs-6">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">操作列表</h3>
                </div>
                <a type="button" class="btn " href="/permissions/create" >增加操作</a>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody><tr>
                            <th style="width: 10px">#</th>
                            <th>操作名称</th>
                            <th>命名空间</th>
                            <th>控制器</th>
                            <th>方法</th>
                            <th>父节点</th>
                            <th>操作</th>
                        </tr>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{$permission->id}}.</td>
                                <td>{{$permission->name}}</td>
                                <td>{{$permission->namespace}}</td>
                                <td>{{$permission->controller}}</td>
                                <td>{{$permission->action}}</td>
                                @if($permission->parent_id == 0)
                                    <td>/</td>
                                @else
                                    <td>{{$permission->parent->name}}</td>
                                @endif
                                <td>
                                    <a type="button" class="btn" href="/permissions/{{$permission->id}}/edit" >编辑</a>
                                    <a type="button" class="btn resource-delete" delete-url="/permissions/{{$permission->id}}" href="#" >删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody></table>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection