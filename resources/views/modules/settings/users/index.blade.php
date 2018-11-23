@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/table.css') }}">
@endpush

@section ('content')
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ count(\App\Models\User::withTrashed()->get()) }}</h3>

                        <p>Jumlah Pengguna</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <div class="small-box-footer">&nbsp;</div>
                </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ count(\Spatie\Permission\Models\Role::whereNotIn('name', ['superadmin'])->get()) }}</h3>

                        <p>Jumlah Peranan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ count(\App\Models\User::whereNull('deleted_at')->get()) }}</h3>

                        <p>Pengguna Aktif</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ count(\App\Models\User::withTrashed()->whereNotNull('deleted_at')->get()) }}</h3>

                        <p>Pengguna Tidak Aktif</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        @include ('components._flashes')
        
        <div class="row">
            <div class="col-md-12">
                <div class="mrg10B pull-right">
                    <div class="btn-group">
                        <button class="btn bg-purple" data-toggle="collapse" data-target="#search" type=""><i class="fa fa-fw fa-search"></i></button>
                        <a href="{{ route('users.create') }}" class="btn bg-purple">
                            <i class="fa fa-fw fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="search" class="box box-solid collapse">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Carian</h3>
                    </div>

                    <div class="box-body">
                        &nbsp;
                        {{ Form::open(['url' => route('users.search'), 'method' => 'GET']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" type="text" name="user_name" placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" type="text" name="user_username" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="text" name="user_email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="form-control" name="user_role">
                                                <option value="0">-- Please choose --</option>
                                                @if (!empty($roles))
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->displayed_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <select class="form-control" name="user_department">
                                                <option value="0">-- Please choose --</option>
                                                @if (!empty($departments))
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 mrg20B pull-right">
                                <button class="btn btn-block btn-primary" type="submit">
                                    Carian
                                </button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Senarai Pengguna</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="tbl-row-init tbl-default">
                                        <th class="max20">#</th>
                                        <th>Nama</th>
                                        <th>No K/P</th>
                                        <th>Peranan</th>
                                        <th>Unit/ Seksyen</th>
                                        <th>Status</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($users))
                                        @foreach ($users as $user)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $user->name ?? 'N/A' }}</td>
                                                <td>{{ $user->ic ?? 'N/A' }}</td>
                                                <td>{{ $user->roles->pluck('displayed_name')->first() }}</td>
                                                <?php 
                                                    $position = '';

                                                    if (!empty($user->unit->displayed_name)) {
                                                        $position = $user->unit->displayed_name;
                                                    } else if (!empty($user->section->displayed_name)) {
                                                        $position = $user->section->displayed_name;
                                                    } else {
                                                        $position = 'N/A';
                                                    }
                                                ?>
                                                <td>{{ $position }}</td>
                                                <td>
                                                    {!! empty($user->deleted_at) ? '<span class="label label-success">Aktif</span>' : '<span class="label label-warning">Tidak Aktif</span>' !!}
                                                </td>
                                                <td class="col-md-1">
                                                    <div class="min90">
                                                        {{ Form::open(['url' => route('users.destroy', $user->id), 'method' => 'DELETE']) }}
                                                            <div class="btn-group">
                                                                <a href="{{ route('users.edit', $user->id) }}" class="btn bg-purple">
                                                                    <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                </a>
                                                                <button class="btn btn-danger" type="submit">
                                                                    <i class="fa fa-fw fa-trash-o"></i>
                                                                </button>
                                                            </div>
                                                        {{ Form::close() }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>Tiada Rekod Dijumpai</tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="pull-right">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@push ('script')
@endpush