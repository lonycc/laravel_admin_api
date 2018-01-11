<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">导航</li>
            @foreach($actions as $action)
                <li class="treeview active">
                    <a href="#">
                        <i class="fa {{$action->class}}"></i>
                        <span>{{$action->name}}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    @if(!$action->children->isEmpty())
                        <ul class="treeview-menu">
                            @foreach($action->children as $subaction)
                                <li class="active"><a href="{{action('Admin\\'.$subaction->controller.'@'.$subaction->action)}}"><i class="fa
                                {{$subaction->class}}"></i> {{$subaction->name}}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>