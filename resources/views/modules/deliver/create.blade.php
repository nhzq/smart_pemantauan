@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endpush

@section ('content')
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Serahan Projek
                    </div>

                    <div class="panel-body">
                        {{ Form::open(['url' => route('deliverables.store', $project->id) , 'method' => 'POST']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Pegawai</label>
                                            <input class="form-control" 
                                                type="text" 
                                                name="officer_name"
                                                value="{{ !empty($project->deliver->officer_name) ? $project->deliver->officer_name : '' }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jawatan</label>
                                            <input class="form-control" 
                                                type="text" 
                                                name="officer_position"
                                                value="{{ !empty($project->deliver->position) ? $project->deliver->position : '' }}"
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh Serahan Projek</label>
                                            <input class="form-control pickdate" 
                                                type="text" 
                                                name="deliverable_date"
                                                value="{{ !empty($project->deliver->deliverable_date) ? $project->deliver->deliverable_date->format('d/m/Y') : '' }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh Penyerahan Projek Secara Rasmi</label>
                                            <input class="form-control pickdate" 
                                                type="text" 
                                                name="official_date"
                                                value="{{ !empty($project->deliver->official_deliverable_date) ? $project->deliver->official_deliverable_date->format('d/m/Y') : '' }}"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 mrg20B mrg20T pull-right">
                                <button class="btn btn-block btn-primary" type="submit">
                                    Simpan
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

@push ('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script>
        $(function () {
            $('.texteditor').summernote({
                toolbar: [],
                height: 100
            });

            $('.pickdate').datepicker({
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                autoclose: true
            });
        });
    </script>
@endpush