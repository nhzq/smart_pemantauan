@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/table.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/panel-tab.css') }}">
@endpush

@section ('content')
    <!-- Content Header (Page header) -->
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        @include ('components._phases')

        <div class="row">
            @include ('components._menu')

            <div class="col-md-9">
                @hasanyrole ('ku')
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                                <i class="fa fa-fw fa-plus"></i> Carta Organisasi Pasukan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhasanyrole
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border panel-header-border-blue">
                                <h3 class="box-title">Carta Organisasi Pasukan</h3>
                            </div>
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <img src="{{ url('storage/projects/' . $project->id . '/org-chart/' . $project->chart->last()->file_name) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    {{ Form::open(['url' => route('chart.store', $project->id), 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Muatnaik Carta Organisasi</h4>
                            </div>
                            <div class="modal-body">
                                <input type="file" name="org_chart" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Muatnaik</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </section>
@endsection

@push ('script')
@endpush
