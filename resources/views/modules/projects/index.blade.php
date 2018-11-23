@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/table.css') }}">
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

                        @hasrole('ku')
                            <a href="{{ route('projects.create') }}" class="btn bg-purple">
                                <i class="fa fa-fw fa-plus"></i>
                            </a>
                        @endhasrole
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="search" class="box box-solid collapse">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Carian</h3>
                    </div>
                    <div class="box-body">
                        &nbsp;
                        {{ Form::open(['url' => route('projects.index'), 'method' => 'GET']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Projek</label>
                                            <input class="form-control" type="text" name="Search_name" placeholder="Nama Projek">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mrg20B pull-right">
                                <button class="btn btn-block btn-primary" type="submit">
                                    Carian
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
                        <h3 class="box-title">Senarai Projek</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="custom-row" class="table table-hover">
                                <thead>
                                    <tr class="tbl-row-init tbl-default">
                                        <th>Jenis Bajet</th>
                                        <th>Jumlah (RM)</th>
                                        <th>#</th>
                                        <th>Nama Projek</th>
                                        <th>Anggaran Kos (RM)</th>
                                        <th>Status</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($projects))
                                        @foreach ($projects as $key => $data)
                                            @include('modules.projects.shared._lists')
                                        @endforeach
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

@push ('script')
    <script src="{{ asset('adminlte/dist/js/rowspanizer.js') }}"></script>
    <script>
        $(function () {
            $("#custom-row").rowspanizer({
                vertical_align: 'middle',
                columns: [0, 1]
            });
        });
    </script>
@endpush
