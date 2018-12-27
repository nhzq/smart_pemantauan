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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tajuk Kontrak</label>
                                            <input class="form-control" 
                                                type="text" 
                                                name="contract_title" 
                                                value="{{ !empty($project->contract->title) ? $project->contract->title : '' }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Kontrak</label>
                                            <input class="form-control" 
                                                type="text" 
                                                name="contract_no"
                                                value="{{ !empty($project->contract->contract_no) ? $project->contract->contract_no : '' }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Perjanjian Kontrak</label>

                                            <?php 
                                                $contract_aggreement_date = '';

                                                if (!empty($project->contract->agreement_date)) {
                                                    $contract_aggreement_date = $project->contract->agreement_date->format('d/m/Y');
                                                }
                                            ?>
                                            <input class="form-control pickdate" 
                                                type="text" 
                                                name="contract_agreement_date"
                                                value="{{ $contract_aggreement_date }}"
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Semakan Kontrak Kepada PUU</label>

                                            <?php 
                                                $contract_review_date = '';

                                                if (!empty($project->contract->puu_review_date)) {
                                                    $contract_review_date = $project->contract->puu_review_date->format('d/m/Y');
                                                }
                                            ?>
                                            <input id="start_date" class="form-control" 
                                                type="text" 
                                                name="contract_review_date"
                                                value="{{ $contract_review_date }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Terima Semakan Kontrak Kepada PUU</label>

                                            <?php 
                                                $contract_receive_date = '';

                                                if (!empty($project->contract->puu_receive_date)) {
                                                    $contract_receive_date = $project->contract->puu_receive_date->format('d/m/Y');
                                                }
                                            ?>
                                            <input  id="end_date" class="form-control" 
                                                type="text" 
                                                name="contract_receive_date"
                                                value="{{ $contract_receive_date }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tempoh Semakan PUU</label>

                                            <?php 
                                                $review = '';
                                                $receive = '';

                                                $duration = '';

                                                if (!empty($project->contract->puu_review_date) && !empty($project->contract->puu_receive_date)) {
                                                    $review = $project->contract->puu_review_date;
                                                    $receive = $project->contract->puu_receive_date;

                                                    $duration = $review->diffInDays($receive) + 1;
                                                }
                                            ?>
                                            <input id="total_days" class="form-control" 
                                                type="text" 
                                                name="duration" 
                                                value="{{ $duration }}"
                                                readonly
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
    <script src="{{ asset('adminlte/plugin/maskMoney/jquery.maskMoney.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('.money-convert').maskMoney();
            
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