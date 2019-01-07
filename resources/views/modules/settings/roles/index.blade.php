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
        @include ('components._flashes')

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ count(\App\Models\User::role('ku')->get()) }}</h3>

                        <p>Jumlah Pengguna: <br /> <b>{{ \Spatie\Permission\Models\Role::where('name', 'ku')->pluck('displayed_name')->first() }}</b></p>

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
                        <h3>{{ count(\App\Models\User::role('ks')->get()) }}</h3>

                        <p>Jumlah Pengguna: <br /> <b>{{ \Spatie\Permission\Models\Role::where('name', 'ks')->pluck('displayed_name')->first() }}</b></p>

                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <div class="small-box-footer">&nbsp;</div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ count(\App\Models\User::role('sub')->get()) }}</h3>

                        <p>Jumlah Pengguna: <br /> <b>{{ \Spatie\Permission\Models\Role::where('name', 'sub')->pluck('displayed_name')->first() }}</b></p>

                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <div class="small-box-footer">&nbsp;</div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>{{ count(\App\Models\User::role('kw')->get()) }}</h3>

                        <p>Jumlah Pengguna: <br /> <b>{{ \Spatie\Permission\Models\Role::where('name', 'kw')->pluck('displayed_name')->first() }}</b></p>

                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <div class="small-box-footer">&nbsp;</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Senarai Peranan
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered font-std">
                                <thead>
                                    <tr class="info">
                                        <th class="max20 text-center">#</th>
                                        <th class="text-center">Nama Paparan</th>
                                        <th class="text-center">Nama (kod)</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($roles))
                                        @foreach ($roles as $role)
                                            <tr>
                                                <th class="col-md-1 text-center align-center">{{ $loop->iteration }}</th>
                                                <td class="col-md-5 align-center">{{ $role->displayed_name }}</td>
                                                <td class="col-md-5 align-center">{{ $role->name }}</td>
                                                <td class="col-md-1 text-center">
                                                    {{ Form::open() }}
                                                        <div class="btn-group">
                                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm bg-purple">
                                                                <i class="fa fa-fw fa-pencil-square-o"></i>
                                                            </a>
                                                        </div>
                                                    {{ Form::close() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="4">No records found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
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