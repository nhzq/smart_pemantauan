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
                        Butiran Kontrak
                    </div>

                    <div class="panel-body">
                        {{ Form::open(['url' => route('contracts.store', $project->id) , 'method' => 'POST']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tajuk Kontrak</label>
                                            <input class="form-control" type="text" name="contract_title">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Kos Kontrak (RM)</label>
                                            <input class="form-control money-convert" type="text" name="contract_cost">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>No Kontrak</label>
                                            <input class="form-control" type="text" name="contract_no">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Perjanjian Kontrak</label>
                                            <input class="form-control pickdate" type="text" name="contract_agreement_date">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Mula Projek</label>
                                            <input class="form-control pickdate" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Siap Projek</label>
                                            <input class="form-control pickdate" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Semakan Kontrak Kepada PUU</label>
                                            <input  id="start_date" class="form-control pickdate" type="text" name="contract_review_date">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Terima Semakan Kontrak Kepada PUU</label>
                                            <input  id="end_date" class="form-control pickdate" type="text" name="contract_receive_date">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tempoh Semakan PUU</label>
                                            <input id="total_days" class="form-control" type="text" name="duration" readonly>
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
    <script type="text/javascript">
        $(function () {
            $('.money-convert').maskMoney();
            
            $('.pickdate').datepicker({
                todayHighlight: true,
                autoclose: true
            });

            $('#start_date').datepicker({
                todayHighlight: true,
                autoclose: true
            }).on('changeDate', function (e) {
                $('#end_date').datepicker('setStartDate', $('#start_date').val());
            });

            $('#end_date').datepicker({
                todayHighlight: true,
                autoclose: true
            }).on('changeDate', function (e) {
                var start = $('#start_date').val();
                var startD = new Date(start);

                var end = $('#end_date').val();
                var endD = new Date(end);

                var diff = parseInt(((endD.getTime() - startD.getTime()) / (24*3600*1000)) + 1);

                $('#total_days').val(diff);
            });
        });
    </script>
@endpush