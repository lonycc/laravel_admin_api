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
                        <h3 class="box-title">编辑用户</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('users.update', ['user'=>$user->id])}}" method="POST">
                        {{method_field('put')}}
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">用户名</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="用户名" />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="password">密码</label>
                                <input type="text" class="form-control" name="password" placeholder="用户密码" />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="email">邮箱</label>
                                <input type="text" class="form-control" name="email" value="{{$user->email}}" placeholder="用户邮箱" />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="realname">备注</label>
                                <input type="text" class="form-control" name="realname" value="{{$user->realname}}" placeholder="用户备注" />
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