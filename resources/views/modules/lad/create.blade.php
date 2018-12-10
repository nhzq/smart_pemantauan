@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/table.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endpush

@section ('content')
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Bayaran Ganti Rugi (LAD)</h3>
                    </div>

                    <div class="box-body">
                        {{ Form::open(['url' => '' , 'method' => 'POST']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh Denda Mula</label>

                                            <?php 
                                                $fine_start = '';

                                                if (!empty($eot = $project->eots->last()->extend_date)) {
                                                    $fine_start = $eot->format('m/d/Y');
                                                } else if (!empty($sst = $project->contractorAppointment->contract_end_date)) {
                                                    $fine_start = $sst->format('m/d/Y');
                                                }
                                            ?>
                                            <input class="form-control" type="text" value="{{ $fine_start }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Denda Sehari</label>

                                            <?php 
                                                $finePerDay = 0;

                                                if (!empty($project_cost = $project->contract->cost)) {
                                                    $finePerDay = $project_cost * 0.001;
                                                }
                                            ?>
                                            <input id="fine-day" class="form-control" orgValue="{{ $finePerDay }}" type="text" value="{{ currency($finePerDay) }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jumlah Hari Denda</label>
                                            <input id="count-days" class="form-control" type="text" name="total_fine_days">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kos LAD</label>
                                            <input id="lad-cost" class="form-control money-convert" type="text" name="payment_amount" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tindakan Diambil</label>
                                            <textarea class="form-control texteditor" name="action_taken" cols="30" rows="5"></textarea>
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
                autoclose: true
            });
        });
    </script>
    <script>
        $(function () {
            $('#count-days').on('keyup', function () {
                $fine = $('#fine-day').attr('orgValue');
                $days = $('#count-days').val();

                $total = parseInt($fine) * parseInt($days);

                $('#lad-cost').val($total);
            });
        });
    </script>
@endpush