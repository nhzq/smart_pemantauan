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
            @include ('modules.reviews.shared._table')
        </div>
    </section>
    <!-- /.content -->
@endsection
