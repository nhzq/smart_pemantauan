@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/panel-tab.css') }}">
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
                                            <a href="{{ route('contracts.create', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Butiran Kontrak
                                            </a>
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
                                Butiran Kontrak
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <tr class="info">
                                                <th class="col-md-3">&nbsp;</th>
                                                <th>Maklumat</th>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tajuk Kontrak</th>
                                                <td>{{ $project->contract->title ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Kos Kontrak (RM)</th>
                                                <td>{{ currency($project->contract->cost) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">No Kontrak</th>
                                                <td>{{ $project->contract->contract_no ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <?php 
                                                    $agreement_date = '';

                                                    if (!empty($project->contract->agreement_date)) {
                                                        $agreement_date = $project->contract->agreement_date->format('m/d/Y');
                                                    }
                                                ?>
                                                <th class="col-md-5">Tarikh Perjanjian Kontrak</th>
                                                <td>{{ $agreement_date }}</td>
                                            </tr>
                                            <tr>
                                                <?php 
                                                    $contract_start_date = '';

                                                    if (!empty($project->contractorAppointment->contract_start_date)) {
                                                        $contract_start_date = $project->contractorAppointment->contract_start_date->format('m/d/Y');
                                                    }
                                                ?>
                                                <th class="col-md-5">Tarikh Mula Projek</th>
                                                <td>{{ $contract_start_date }}</td>
                                            </tr>
                                            <tr>
                                                <?php 
                                                    $contract_end_date = '';

                                                    if (!empty($project->contractorAppointment->contract_end_date)) {
                                                        $contract_end_date = $project->contractorAppointment->contract_end_date->format('m/d/Y');
                                                    }
                                                ?>
                                                <th class="col-md-5">Tarikh Siap Projek</th>
                                                <td>{{ $contract_end_date }}</td>
                                            </tr>
                                            <tr>
                                                <?php 
                                                    $puu_review_date = '';

                                                    if (!empty($project->contract->puu_review_date)) {
                                                        $puu_review_date = $project->contract->puu_review_date->format('m/d/Y');
                                                    }
                                                ?>
                                                <th class="col-md-5">Tarikh Semakan Kontrak Kepada PUU</th>
                                                <td>{{ $puu_review_date }}</td>
                                            </tr>
                                            <tr>
                                                <?php 
                                                    $puu_receive_date = '';

                                                    if (!empty($project->contract->puu_receive_date)) {
                                                        $puu_receive_date = $project->contract->puu_receive_date->format('m/d/Y');
                                                    }
                                                ?>
                                                <th class="col-md-5">Tarikh Terimaan Kontrak Kepada PUU</th>
                                                <td>{{ $puu_receive_date }}</td>
                                            </tr>
                                            <tr>
                                                <?php 
                                                    $review = '';
                                                    $receive = '';

                                                    $duration = '';

                                                    if (!empty($project->contract->puu_review_date) && !empty($project->contract->puu_receive_date)) {
                                                        $review = $project->contract->puu_review_date;
                                                        $receive = $project->contract->puu_receive_date;

                                                        $duration = $review->diffInDays($receive) . ' hari';
                                                    }
                                                ?>
                                                <th class="col-md-5">Tempoh Semakan PUU</th>
                                                <td>{{ $duration }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push ('script')
    <script>
        $(function () {
            var hash = document.location.hash;
            var prefix = "tab_";
            if (hash) {
                $('.panel-tabs a[href="'+hash.replace(prefix,"")+'"]').tab('show');
            } 

            // Change hash for page-reload
            $('.panel-tabs a').on('shown.bs.tab', function (e) {
                window.location.hash = e.target.hash.replace("#", "#" + prefix);
            });
        });
    </script>
@endpush
