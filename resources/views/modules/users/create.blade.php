@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/spacing.css') }}">

@endpush

@section ('content')
    @include ('components._breadcrumbs')
    
    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')
        
        <div class="row mrg10T">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Create User</h3>
                    </div>
                    <div class="box-body">
                        <div class="mrg10T mrg10B">
                            {{ Form::open(['url' => route('users.store'), 'method' => 'POST']) }}
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('user_name') ? 'has-error' : '' }}">
                                                <label>Name</label>
                                                <input class="form-control" type="text" name="user_name" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('user_username') ? 'has-error' : '' }}">
                                                <label>Username</label>
                                                <input class="form-control" type="text" name="user_username" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('user_email') ? 'has-error' : '' }}">
                                                <label>Email</label>
                                                <input class="form-control" type="text" name="user_email" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('user_role') ? 'has-error' : '' }}">
                                                <label>Role</label>
                                                <select class="form-control" name="user_role">
                                                    <option value="0">-- Please choose --</option>
                                                    @if (!empty($roles))
                                                        @foreach ($roles as $role)
                                                            <option value="{{ strtolower($role->name) }}">{{ helperRoleName($role->name) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('user_jabatan') ? 'has-error' : '' }}">
                                                <label>Jabatan</label>
                                                <select class="form-control" name="user_jabatan">
                                                    <option value="0">-- Please choose --</option>
                                                    @if (!empty($jabatans))
                                                        @foreach ($jabatans as $jabatan)
                                                            <option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mrg10T">
                                            <small><i>p/s: User's default password would be <strong>password</strong></i></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 mrg20B mrg20T pull-right">
                                    <button class="btn btn-block btn-primary" type="submit">
                                        Save
                                    </button>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push ('script')
@endpush