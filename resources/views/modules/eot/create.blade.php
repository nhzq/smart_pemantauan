@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">\
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/nhzq.css') }}">
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
                        Lanjutan Masa (EOT)
                    </div>

                    <div class="panel-body">
                        {{ Form::open(['url' => route('eot.store', $project->id) , 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            <?php 
                                $eot = null; 
                                $eot_doc = null;

                                if (!empty($project->eots->first())) {
                                    $eot = $project->eots->first();
                                }

                                if (!empty($project->eot_docs)) {
                                    $eot_doc = $project->eot_docs;
                                }
                            ?>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Permohonan</label>
                                            <input class="form-control pickdate" 
                                                type="text" 
                                                name="application_date" 
                                                value="{{ !empty($eot) ? $eot->application_date->format('d/m/Y') : '' }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Kelulusan EOT</label>
                                            <input class="form-control pickdate"
                                                type="text" 
                                                name="eot_approval_date"
                                                value="{{ !empty($eot) ? $eot->eot_approval_date->format('d/m/Y') : '' }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Lanjut Tempoh</label>
                                            <input class="form-control pickdate" 
                                                type="text" 
                                                name="extension_date"
                                                value="{{ !empty($eot) ? $eot->extension_date->format('d/m/Y') : '' }}"
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Surat EOT</label>
                                            <input class="form-control" type="file" name="eot_doc[]" multiple>
                                           {{--  @if (!empty($eot_doc->where('category', 'surat-eot')))
                                                <div class="mrg10T">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <a href="">{{ count($eot_doc->where('category', 'surat-eot')) }} fail yang telah dimuat naik.</a>
                                                        </li>
                                                    </ul> 
                                                </div>
                                            @endif --}}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Perjanjian Tambahan</label>
                                            <input class="form-control" type="file" name="agreement_doc[]" multiple>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Klausa Perlanjutan (Bulan)</label>
                                            <textarea class="form-control texteditor" name="clause" cols="30" rows="5">
                                                {!! !empty($eot) ? $eot->clause : '' !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Catatan</label>
                                            <textarea class="form-control texteditor" name="remarks" cols="30" rows="5">
                                                {!! !empty($eot) ? $eot->remarks : '' !!}
                                            </textarea>
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