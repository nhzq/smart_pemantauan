@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
@endpush

@section ('content')
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-borderless">
                    <div class="panel-body panel-nav">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button class="btn btn-diamond" data-toggle="collapse" data-target="#search" type="">
                                            <i class="fa fa-fw fa-search"></i> Carian
                                        </button>
                                        <a href="{{ route('officers.create') }}" class="btn btn-diamond">
                                            <i class="fa fa-fw fa-plus"></i> Pengguna
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        {{ Form::open() }}
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
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <select class="form-control" name="user_department">
                                                <option value="0">-- Please choose --</option>
                                                
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
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Unisel/ SSDU
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered font-std">
                                <thead>
                                    <tr class="info">
                                        <th class="max20 text-center">#</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">No K/P</th>
                                        <th class="text-center">Peranan</th>
                                        <th class="text-center">Projek</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($users))
                                        @foreach ($users as $data)
                                            <tr>
                                                <td class="text-center align-center">{{ $loop->iteration }}</td>
                                                <td class="align-center">{{ $data->name ?? '' }}</td>
                                                <td class="text-center align-center">{{ $data->ic ?? '' }}</td>
                                                <td class="text-center align-center">
                                                    @if (!empty($data->roles))
                                                        @foreach ($data->roles as $role)
                                                            {{ $role->displayed_name ?? '' }}
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="align-center">
                                                    @if (!empty($data->appointedProject))
                                                        @foreach ($data->appointedProject as $project)
                                                            {{ $project->name ?? '' }}
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="pull-right">
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