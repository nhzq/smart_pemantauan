@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endpush

@section ('content')
    <!-- Content Header (Page header) -->
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Maklumat Keputusan Perolehan
                    </div>
                    
                    <div class="panel-body">
                        {{ Form::open(['url' => route('results.store', $project->id), 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            <div class="col-md-12">
                                <hr>
                                    <div class="text-center">
                                        <strong>Maklumat Keputusan</strong>
                                    </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh Kelulusan</label>
                                            <?php 
                                                $result_approval_date = '';

                                                if ($project->actual_approval_date) {
                                                    $result_approval_date = $project->actual_approval_date->format('d/m/Y');
                                                }
                                            ?>
                                            <input class="form-control pickdate" 
                                                type="text" 
                                                name="result_approval_date" 
                                                value="{{ $result_approval_date }}"
                                            >
                                        </div>
                                    </div>
                                    
                                    @if ($project->lookup_collection_type_id != 1)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                @if ($project->lookup_collection_type_id == 2 || $project->lookup_collection_type_id == 3 || $project->lookup_collection_type_id == 4)
                                                    <label>Minit Mesyuarat Kelulusan</label>
                                                @endif
                                                @if ($project->lookup_collection_type_id == 5 || $project->lookup_collection_type_id == 6)
                                                    <label>Surat Kelulusan Khas PWN</label>
                                                @endif

                                                <input class="form-control" type="file" name="result_minute_meeting[]" multiple>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <hr>
                                    <div class="text-center">
                                        <strong>Butiran Kewangan/ Sumber Pembiyaan</strong>
                                    </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kos Projek Sebenar (RM)</label>
                                            <input id="actual_cost" class="form-control money-convert" 
                                                type="text" 
                                                name="result_actual_project_cost"
                                                value="{{ currency($project->actual_project_cost) }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Peruntukan Semasa (RM)</label>
                                            <input id="estimate_total_cost" class="form-control money-convert" 
                                                type="text" 
                                                value="{{ currency($project->estimate_cost) }}" 
                                                readonly
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Butiran (Justifikasi Kos Projek Sebenar)</label>
                                            <textarea class="form-control texteditor" name="result_justification">
                                                {{ $project->justification ?? '' }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 pull-right mrg20T">
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
    <script src="{{ asset('adminlte/plugin/maskMoney/jquery.maskMoney.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.pickdate').datepicker({
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            $('.texteditor').summernote({
                toolbar: [],
                height: 100
            });

            $('.money-convert').maskMoney();

            $('#actual_cost').on('blur', function () {
                var estimate = $('#estimate_total_cost').val().replace(/,/g, '');
                var actual = $('#actual_cost').val().replace(/,/g, '');

                if (parseFloat(actual) > parseFloat(estimate)) {
                    alert('Kos projek sebenar telah melebihi peruntukan semasa. Sila semak semula jumlah yang dimasukkan.');
                    $('#actual_cost').val('');
                }
            });
        });
    </script>
@endpush
