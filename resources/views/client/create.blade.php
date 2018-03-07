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
                        <h3 class="box-title">添加用户</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('clients.store')}}" method="POST">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">用户名</label>
                                <input type="text" class="form-control" name="name" />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="email">邮箱</label>
                                <input type="email" class="form-control" name="email" />
                            </div>
                        </div>                        
                        <div class="box-body">
                            <div class="form-group">
                                <label for="password">密码</label>
                                <input type="password" class="form-control" name="password" />
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="realname">备注</label>
                                <input type="text" class="form-control" name="realname" />
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="status">状态</label>
                                <input type="radio" name="status" value="1" checked /><label>正常</label>
                                <input type="radio" name="status" value="0" /><label>锁定</label>
                            </div>
                        </div>   

                        <div class="box-body">
                            <div class="form-group">
                                <label for="check_ip">检查IP</label>
                                <input type="radio" name="check_ip" value="1" /><label>是</label>
                                <input type="radio" name="check_ip" value="0" checked /><label>否</label>
                            </div>
                        </div>                        
                        <div class="box-body">
                            <div class="form-group">
                                <label for="ip">限定IP</label>
                                <input type="text" class="form-control" name="ip" value="0.0.0.0" />
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