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
                            <button class="btn get-purple"><i class="fa fa-fw fa-plus"></i></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Roles and Permission</h3>
                    </div>
                    <div class="box-body">
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
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $role->name ?? 'N/A' }}</td>
                                                <td>{{ 'N/A' }}</td>
                                                <td>{{ 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>No records found</tr>
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

@endsection

@push ('script')
@endpush