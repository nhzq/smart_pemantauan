@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
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
                        Rekod-rekod disenggara
                    </div>

                    <div class="panel-body">
                        {{ Form::open(['url' => route('records.store', $project->id) , 'method' => 'POST']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Rekod</label>
                                            <input class="form-control" 
                                                type="text" 
                                                name="record_type" 
                                                value="{{ !empty($project->record->record_type) ? $project->record->record_type : '' }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Lokasi Simpanan Rekod</label>
                                            <input class="form-control" 
                                                type="text" 
                                                name="record_location"
                                                value="{{ !empty($project->record->record_location) ? $project->record->record_location : '' }}"
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Pegawai Bertanggungjawab</label>
                                            <input class="form-control money-convert" 
                                                type="text" 
                                                name="record_officer"
                                                value="{{ !empty($project->record->authorized_officer) ? $project->record->authorized_officer : '' }}"
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
@endpush