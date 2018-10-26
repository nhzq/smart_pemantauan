<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> --}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <!-- Dashboard section -->
            <li class="{{ request()->is('home') ? 'active' : '' }}">
                <a href="{{ url('/home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <!-- Dashboard end -->

            <!-- Projek section -->
            
            <!-- End Projek -->
            
            <!-- Setting section -->
            @if (\Auth::user()->hasRole('superadmin'))
                @if (request()->is('users*'))
                    <li class="active treeview">
                @else 
                    <li class="treeview">
                @endif
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Setting</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <!-- User section -->
                        <li class="{{ request()->is('users*') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}"><i class="fa fa-circle-o {{ request()->is('users*') ? 'text-aqua' : '' }}"></i> Users</a>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- Setting end -->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>