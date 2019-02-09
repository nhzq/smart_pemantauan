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
                        Bon Perlaksanaan
                    </div>

                    <div class="panel-body">
                        {{ Form::open(['url' => route('bond.store', $project->id) , 'method' => 'POST']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Wang Jaminan Perlaksanaan</label>
                                            <input class="form-control" 
                                                type="text" 
                                                name="guarantee_money" 
                                                value="{{ !empty($project->bond->guarantee_money) ? $project->bond->guarantee_money : '' }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jumlah Pembayaran (RM)</label>
                                            <input class="form-control money-convert" 
                                                type="text" 
                                                name="total_payment" 
                                                value="{{ !empty($project->bond->total_payment) ? currency($project->bond->total_payment) : '' }}"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nilai Bond (RM)</label>
                                            <input class="form-control money-convert" 
                                                type="text" 
                                                name="bond_value" 
                                                value="{{ !empty($project->bond->bond_value) ? currency($project->bond->bond_value) : '' }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Bank</label>
                                            <input class="form-control" 
                                                type="text" 
                                                name="bank_name" 
                                                value="{{ !empty($project->bond->bank_name) ? $project->bond->bank_name : '' }}"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Awal</label>
                                            <?php 
                                                $start_date = null;

                                                if (!empty($project->bond->start_date)) {
                                                    $start_date = $project->bond->start_date->format('d/m/Y');
                                                }
                                            ?>
                                            <input id="start_date" class="form-control pickdate" 
                                                type="text" 
                                                name="start_date" 
                                                value="{{ $start_date }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Akhir</label>
                                            <?php 
                                                $end_date = null;

                                                if (!empty($project->bond->end_date)) {
                                                    $end_date = $project->bond->end_date->format('d/m/Y');
                                                }
                                            ?>
                                            <input id="end_date" class="form-control pickdate" 
                                                type="text" 
                                                name="end_date" 
                                                value="{{ $end_date }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tempoh Bond</label>
                                            <?php
                                                $diff = 0;

                                                if (!empty($project->bond->end_date) && !empty($project->bond->start_date)) {
                                                    $diff = $project->bond->end_date->diffInDays($project->bond->start_date);
                                                }
                                            ?>
                                            <input id="total_days" class="form-control" 
                                                type="text"
                                                value="{{ $diff }}"
                                                readonly
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Catatan</label>
                                            <textarea class="form-control texteditor" name="notes" cols="30" rows="5">
                                                {!! !empty($project->bond->notes) ? $project->bond->notes : '' !!}
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
    <script src="{{ asset('adminlte/plugin/maskMoney/jquery.maskMoney.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script>
        $(function () {
            $('.money-convert').maskMoney();

            $('.texteditor').summernote({
                toolbar: [],
                height: 100
            });

            $('.pickdate').datepicker({
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            $('#start_date').datepicker({
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                autoclose: true
            }).on('changeDate', function (e) {
                $('#end_date').datepicker('setStartDate', $('#start_date').val());
            });

            $('#end_date').datepicker({
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                autoclose: true
            }).on('changeDate', function (e) {
                var startD = $("#start_date").datepicker('getDate');
                var endD = $("#end_date").datepicker('getDate');

                var diff = Math.round(((endD.getTime() - startD.getTime()) / (1000*60*60*24)) + 1);

                $('#total_days').val('');
                $('#total_days').val(diff);
            });
        });
    </script>
@endpush