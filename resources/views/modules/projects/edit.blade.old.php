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
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Create Project</h3>
                    </div>
                    <div class="box-body">
                        {{ Form::open(['url' => route('projects.update', $project->id), 'method' => 'PUT']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('project_name') ? 'has-error' : '' }}">
                                            <label>Project's Name</label>
                                            <input class="form-control" type="text" name="project_name" placeholder="Name" value="{{ $project->name ?? 'N/A' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('project_cost') ? 'has-error' : '' }}">
                                            <label>Project's Cost</label>
                                            <input class="form-control" type="text" name="project_cost" placeholder="Cost" value="{{ $project->cost ?? 'N/A' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('project_description') ? 'has-error' : '' }}">
                                            <label>Description</label>
                                            <textarea name="project_description" id="" cols="30" rows="3" class="form-control">{{ $project->description ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mrg20B pull-right">
                                <button class="btn btn-block btn-primary" type="submit">
                                    Update
                                </button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
