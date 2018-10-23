@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css">
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
                            {{ Form::open(['url' => route('roles.update', $role->id), 'method' => 'PUT']) }}
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Role Name</label>
                                            <input class="form-control" type="text" name="role_name" placeholder="Role name" value="{{ $role->name ?? '' }}">
                                        </div>
                                        <div class="col-md-8">
                                            <label>Permission</label>
                                            <div class="vertical-scroll">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Permissions</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (!empty($permissions))
                                                                @foreach ($permissions as $permission)
                                                                    <tr>
                                                                        <?php
                                                                            if (in_array($permission->name, $role->getAllPermissions()->pluck('name')->toArray())) {
                                                                                $checked = 'checked';
                                                                            } else {
                                                                                $checked = '';
                                                                            }
                                                                        ?>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $permission->name }}</td>
                                                                        <td>
                                                                            <input type="checkbox" name="permission_name[]" class="flat-red" value="{{ $permission->name }}" {{ $checked }}>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
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