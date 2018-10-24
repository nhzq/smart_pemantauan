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
                        <h3 class="box-title">Update role</h3>
                    </div>
                    <div class="box-body">
                        <div class="mrg10T mrg10B">
                            {{ Form::open(['url' => route('users.update', $user->id), 'method' => 'PUT']) }}
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Name</label>
                                            <input class="form-control" type="text" name="user_name" placeholder="Name" value="{{ $user->name ?? '' }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Email</label>
                                            <input class="form-control" type="text" name="user_email" placeholder="Email" value="{{ $user->email ?? '' }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Role</label>
                                            <select class="form-control" name="user_role">
                                                <option>-- Please choose --</option>
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
                                                            {{ ucwords($role->name) }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
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