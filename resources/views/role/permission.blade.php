@extends('layout.main')
@section('content')
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">权限列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="/roles/{{$role->id}}/permission" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                {{--@foreach($permissions as $permission)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]"
                                                   @if ($myPermissions->contains($permission))
                                                   checked
                                                   @endif
                                                   value="{{$permission->id}}">
                                            {{$permission->name}}
                                        </label>
                                    </div>
                                @endforeach--}}

                                @foreach($permissions as $permission)
                                    <div class="checkbox">
                                        <table>
                                            <tr>
                                                <td>
                                                    <label>
                                                        <input type="checkbox" name="permissions[]" id="action_{{$permission['id']}}" onclick="parentChange(this,{{$permission['id']}})"
                                                               @if (in_array($permission['id'],$myPermissions))
                                                               checked
                                                               @endif
                                                               value="{{$permission['id']}}">{{$permission['name']}}
                                                    </label>
                                                </td>
                                                <td></td><td></td><td></td><td></td><td></td>
                                            </tr>
                                            @if(count($permission['children']) != 0)
                                                @foreach($permission['children'] as $children)
                                                    <tr>
                                                        <td></td>
                                                        @foreach($children as $sub_children)
                                                            <td>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" class="action_{{$permission['id']}}" onclick="childrenChange(this,{{$permission['id']}})"
                                                                           @if (in_array($sub_children['id'],$myPermissions))
                                                                           checked
                                                                           @endif
                                                                           value="{{$sub_children['id']}}">{{$sub_children['name']}}
                                                                </label>&nbsp;
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </table>



                                    </div>
                                @endforeach
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