@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
@endpush

@section ('content')
    @include ('components._breadcrumbs')
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="mrg10B pull-right">
                    <div class="btn-group">
                        <a href="{{ route('roles.create') }}">
                            <button class="btn bg-purple"><i class="fa fa-fw fa-plus"></i></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        @include ('components._flashes')
        
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Roles and Permission</h3>
                    </div>
                    <div class="box-body">
                        <div class="vertical-scroll">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Roles</th>
                                            <th>Permission</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($roles))
                                            @foreach ($roles as $role)
                                                <tr>
                                                    <th>{{ $roles->perPage() * ($roles->currentPage() - 1) + $loop->iteration }}</th>
                                                    <td>{{ ucwords($role->name) ?? 'N/A' }}</td>
                                                    <td>
                                                        @if (!empty($role->getAllPermissions()))
                                                            @forelse ($role->getAllPermissions() as $perm)
                                                                <ul>
                                                                    <li>{{ $perm->name}}</li>
                                                                </ul>
                                                            @empty
                                                                <ul>
                                                                    <li>N/A</li>
                                                                </ul>
                                                            @endforelse
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group-width">
                                                            <div class="btn-group">
                                                                <a href="{{ route('roles.edit', $role->id) }}">
                                                                    <button class="btn bg-purple" type="submit">
                                                                        <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>No records found</tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="pull-right">
                           {{ $roles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push ('script')
@endpush