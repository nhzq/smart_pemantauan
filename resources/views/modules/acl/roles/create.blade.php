@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
@endpush

@section ('content')
    @include ('components._breadcrumbs')
    
    <!-- Main content -->
    <section class="content">
        <div class="row mrg10T">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Create role</h3>
                    </div>
                    <div class="box-body">
                        <div class="mrg10T mrg10B">
                            {{ Form::open(['url' => route('roles.store'), 'method' => 'POST']) }}
                                <div class="col-md-4">
                                    <label>Role Name</label>
                                    <input class="form-control" type="text" name="role_name" placeholder="Role name">
                                </div>
                                <div class="col-md-8">
                                    <label>Permission</label>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Permissions</th>
                                                    <th>On/ Off</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($permissions))
                                                    @foreach ($permissions as $permission)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $permission->name }}</td>
                                                            <td>Action</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
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