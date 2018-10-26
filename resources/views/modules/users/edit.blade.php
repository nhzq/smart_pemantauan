@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
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
                        <h3 class="box-title">Update User</h3>
                    </div>
                    <div class="box-body">
                        <div class="mrg10T mrg10B">
                            {{ Form::open(['url' => route('users.update', $user->id), 'method' => 'PUT']) }}
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('user_name') ? 'has-error' : '' }}">
                                                <label>Name</label>
                                                <input class="form-control" type="text" name="user_name" placeholder="Name" value="{{ $user->name ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('user_username') ? 'has-error' : '' }}">
                                                <label>Username</label>
                                                <input class="form-control" type="text" name="user_username" placeholder="Username" value="{{ $user->username ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('user_email') ? 'has-error' : '' }}">
                                                <label>Email</label>
                                                <input class="form-control" type="text" name="user_email" placeholder="Email" value="{{ $user->email ?? '' }}">
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
                                                            <?php 
                                                                $selected = '';

                                                                if (!is_null($user->roles->pluck('name')->first())) {
                                                                    if ($user->roles->pluck('name')->first() == $role->name) {
                                                                        $selected = 'selected';
                                                                    }
                                                                }
                                                            ?>
                                                            <option value="{{ strtolower($role->name) }}" {{ $selected }}>
                                                                {{ helperRoleName($role->name) }}
                                                            </option>
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
                                                            <?php 
                                                                $selected = '';

                                                                if (!is_null($user->jabatan->id)) {
                                                                    if ($user->jabatan->id == $jabatan->id) {
                                                                        $selected = 'selected';
                                                                    }
                                                                }
                                                            ?>
                                                            <option value="{{ $jabatan->id }}" {{ $selected }}>
                                                                {{ $jabatan->nama }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 mrg20B mrg20T pull-right">
                                    <button class="btn btn-block btn-primary" type="submit">
                                        Save
                                    </button>
                                </div>
                                
                                @if (!is_null($user->deleted_at))
                                    <div class="col-md-2 mrg20B mrg20T pull-left">
                                        <a href="{{ route('users.activate', $user->id) }}" class="btn btn-block btn-info" type="submit">
                                            Activate
                                        </a>
                                    </div>
                                @endif

                                @if (is_null($user->deleted_at))
                                    <div class="col-md-2 mrg20B mrg20T pull-left">
                                        <a href="{{ route('users.reset', $user->id) }}" class="btn btn-block btn-warning" type="submit">
                                            Reset Password
                                        </a>
                                    </div>
                                @endif
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push ('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
            });
        });
    </script>
@endpush