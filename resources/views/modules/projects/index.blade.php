@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
@endpush

@section ('content')
    <!-- Content Header (Page header) -->
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        <div class="row">
            <div class="col-md-12">
                <div class="mrg10B pull-right">
                    <div class="btn-group">
                        <button class="btn bg-purple" data-toggle="collapse" data-target="#search" type=""><i class="fa fa-fw fa-search"></i></button>
                        <a href="{{ route('projects.create') }}" class="btn bg-purple">
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
                        <h3 class="box-title">Search</h3>
                    </div>
                    <div class="box-body">
                        &nbsp;
                        {{ Form::open(['url' => route('projects.index'), 'method' => 'GET']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Project's Name</label>
                                            <input class="form-control" type="text" name="Search_name" placeholder="Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mrg20B pull-right">
                                <button class="btn btn-block btn-primary" type="submit">
                                    Search
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
                        <h3 class="box-title">List of Projects</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="max20">#</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($projects) > 0)
                                        @foreach ($projects as $project)
                                            <tr>
                                                <th class="col-md-1">{{ $projects->perPage() * ($projects->currentPage() - 1) + $loop->iteration }}</th>
                                                <td class="col-md-5 min200">{{ $project->name ?? 'N/A' }}</td>
                                                <td class="col-md-3">{{ 'RM ' . helperCurrency($project->cost) ?? 'N/A' }}</td>
                                                <td class="col-md-2">
                                                    @include ('components._status')
                                                </td>
                                                <td class="col-md-1">
                                                    <div class="min90">
                                                        {{ Form::open(['url' => route('projects.destroy', $project->id), 'method' => 'DELETE']) }}
                                                            <div class="btn-group">
                                                                <a href="{{ route('projects.edit', $project->id) }}" class="btn bg-purple">
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

                                        <tr>
                                            <th colspan="2">Jumlah</th>
                                            <td>
                                                <strong>{{ 'RM ' . helperCurrency(end($projects->toArray()['data'])['total_amount']) ?? 'N/A' }}</strong>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>No records found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="pull-right">
                            {{ $projects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
