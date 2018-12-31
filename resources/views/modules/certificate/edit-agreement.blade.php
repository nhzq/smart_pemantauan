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
                        Pengakuan Persetujuan Kontraktor ke atas Perakuan Akaun dan Bayaran Muktamad 
                    </div>

                    <div class="panel-body">
                        {{ Form::open(['url' => route('certificates.store', $project->id), 'method' => 'POST']) }}
                            <input type="hidden" name="part" value="2">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading bck-diamond font-h5">
                                            1. Maklumat Saksi
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-sm-12 mrg10T">
                                                <div class="form-group">
                                                    <label>Tarikh</label>
                                                    <input class="form-control pickdate" 
                                                        type="text" 
                                                        name="witness_date" 
                                                        value="{{ !empty($project->certificate->witness_date) ? $project->certificate->witness_date->format('d/m/Y') : '' }}"
                                                    >
                                                </div>

                                                <div class="form-group">
                                                    <label>Nama Pegawai</label>
                                                    <input class="form-control" 
                                                        type="text" 
                                                        name="witness_officer_name"
                                                        value="{{ !empty($project->certificate->witness_officer_name) ? $project->certificate->witness_officer_name : '' }}"
                                                    >
                                                </div>

                                                <div class="form-group">
                                                    <label>Nama Penuh</label>
                                                    <input class="form-control" 
                                                        type="text" 
                                                        name="witness_name"
                                                        value="{{ !empty($project->certificate->witness_name) ? $project->certificate->witness_name : '' }}"
                                                    >
                                                </div>

                                                <div class="form-group">
                                                    <label>No MyKad</label>
                                                    <input class="form-control" 
                                                        type="text" 
                                                        name="witness_ic"
                                                        value="{{ !empty($project->certificate->witness_ic) ? $project->certificate->witness_ic : '' }}"
                                                    >
                                                </div>

                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control texteditor" name="witness_address" cols="30" rows="5">
                                                        {{ !empty($project->certificate->witness_address) ? $project->certificate->witness_address : '' }}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading bck-diamond font-h5">
                                            2. Maklumat Kontraktor
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-sm-12 mrg10T">
                                                <div class="form-group">
                                                    <label>Tarikh</label>
                                                    <input class="form-control pickdate" 
                                                        type="text" 
                                                        name="contractor_date"
                                                        value="{{ !empty($project->certificate->contractor_date) ? $project->certificate->contractor_date->format('d/m/Y') : '' }}"
                                                    >
                                                </div>

                                                <div class="form-group">
                                                    <label>Nama Penuh</label>
                                                    <input class="form-control" 
                                                        type="text" 
                                                        name="contractor_name"
                                                        value="{{ !empty($project->certificate->contractor_name) ? $project->certificate->contractor_name : '' }}"
                                                    >
                                                </div>

                                                <div class="form-group">
                                                    <label>No MyKad</label>
                                                    <input class="form-control" 
                                                        type="text" 
                                                        name="contractor_ic"
                                                        value="{{ !empty($project->certificate->contractor_ic) ? $project->certificate->contractor_ic : '' }}"
                                                    >
                                                </div>

                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control texteditor" name="contractor_address" cols="30" rows="5">
                                                        {{ !empty($project->certificate->contractor_address) ? $project->certificate->contractor_address : '' }}
                                                    </textarea>
                                                </div>
                                            </div>
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