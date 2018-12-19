@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
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
                    <div class="panel panel-borderless">
                        <div class="panel-body panel-nav">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button class="btn btn-diamond" data-toggle="modal" data-target="#modal-default">
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
                        <div class="panel panel-borderless">
                            <div class="panel-heading panel-dark">
                                Carta Organisasi Pasukan
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        @if (!empty($project->chart->last()->file_name))
                                            <img src="{{ url('storage/projects/' . $project->id . '/org-chart/' . $project->chart->last()->file_name) }}" class="img-responsive mrg10B">
                                        @endif
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
