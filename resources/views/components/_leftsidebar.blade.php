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
            <li class="header">Navigasi Utama</li>

            <!-- Dashboard section -->
            <li class="{{ request()->is('home') ? 'active' : '' }}">
                <a href="{{ url('/home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <!-- Dashboard end -->

            <!-- Financial section -->
            @hasanyrole ('kw')
                @if (request()->is('*allocations*'))
                    <li class="active treeview">
                @else 
                    <li class="treeview">
                @endif
                        <a href="#">
                            <i class="fa fa-dollar"></i>
                            <span>Kewangan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php 
                                $active = '';
                                $textAqua = '';

                                if (request()->is('*allocations*') || request()->is('*provisions*')) {
                                    $active = 'active';
                                    $textAqua = 'text-aqua';
                                }
                            ?>
                            <li class="{{ $active }}">
                                <a href="{{ route('provisions.index') }}"><i class="fa fa-circle-o {{ $textAqua }}"></i> Peruntukan</a>
                            </li>

                            <li class="{{ request()->is('*transfer*') ? 'active' : '' }}">
                                <a href="{{ route('transfer.list.index') }}"><i class="fa fa-circle-o {{ request()->is('*transfer*') ? 'text-aqua' : '' }}"></i> Pindah Peruntukan</a>
                            </li>

                            <li class="">
                                <a href=""><i class="fa fa-circle-o"></i> Bayaran Kemajuan</a>
                            </li>
                        </ul>
                    </li>
            @endhasanyrole
            <!-- Financial end -->

            <!-- Project section -->
            @hasanyrole ('ku|ks|sub')
                <li class="{{ request()->is('projects*') ? 'active' : '' }}">
                    <a href="{{ route('projects.index') }}">
                        <i class="fa fa-briefcase"></i> <span>Projek</span>
                    </a>
                </li>
            @endhasanyrole
            <!-- End Project -->

            <!-- Reviews -->
            @hasanyrole ('ketua-seksyen|ketua-jabatan-bahagian-teknologi-maklumat')
                <li class="{{ request()->is('reviews*') ? 'active' : '' }}">
                    <a href="{{ route('reviews.index') }}">
                        <i class="fa fa-lightbulb-o"></i> <span>Semakan</span>
                    </a>
                </li>
            @endhasanyrole
            <!-- End Reviews -->
            
            <!-- Setting section -->
            @hasanyrole ('superadmin')
                @if (request()->is('*users*') || request()->is('*units*') || request()->is('*sections*') || request()->is('*roles*'))
                    <li class="active treeview">
                @else 
                    <li class="treeview">
                @endif
                    <a href="#">
                        <i class="fa fa-gear"></i>
                        <span>Tetapan</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <!-- User section -->
                        <li class="{{ request()->is('*users*') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}"><i class="fa fa-circle-o {{ request()->is('*users*') ? 'text-aqua' : '' }}"></i> Pengguna</a>
                        </li>

                        <!-- Role section -->
                        <li class="{{ request()->is('*roles*') ? 'active' : '' }}">
                            <a href="{{ route('roles.index') }}"><i class="fa fa-circle-o {{ request()->is('*roles*') ? 'text-aqua' : '' }}"></i> Peranan</a>
                        </li>

                        <!-- Section section -->
                        <li class="{{ request()->is('*sections*') ? 'active' : '' }}">
                            <a href="{{ route('sections.index') }}"><i class="fa fa-circle-o {{ request()->is('*sections*') ? 'text-aqua' : '' }}"></i> Seksyen</a>
                        </li>

                        <!-- Unit section -->
                        <li class="{{ request()->is('*units*') ? 'active' : '' }}">
                            <a href="{{ route('units.index') }}"><i class="fa fa-circle-o {{ request()->is('*units*') ? 'text-aqua' : '' }}"></i> Unit</a>
                        </li>
                    </ul>
                </li>
            @endhasanyrole
            <!-- Setting end -->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>