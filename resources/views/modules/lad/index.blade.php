@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
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
                                            <a href="{{ route('lad.create', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Kemaskini LAD
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
                                Bayaran Ganti Rugi (LAD)
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered font-std">
                                        <tr class="info">
                                            <th class="col-md-3">&nbsp;</th>
                                            <th>Maklumat</th>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Tarikh Denda Mula</th>

                                            <?php 
                                                $fine_start = '';

                                                if (!empty($eot = $project->eots->last()->extend_date)) {
                                                    $fine_start = $eot->format('m/d/Y');
                                                } else if (!empty($sst = $project->contractorAppointment->contract_end_date)) {
                                                    $fine_start = $sst->format('m/d/Y');
                                                }
                                            ?>
                                            <td>{{ $fine_start }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Denda Sehari</th>

                                            <?php 
                                                $finePerDay = 0;

                                                if (!empty($project_cost = $project->contract->cost)) {
                                                    $finePerDay = $project_cost * 0.001;
                                                }
                                            ?>
                                            <td>{{ currency($finePerDay) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Jumlah Hari Denda</th>
                                            <td>{{ !empty($project->lads->last()->total_days) ? $project->lads->last()->total_days : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Kos LAD</th>
                                            <td>{{ !empty($project->lads->last()->total_fine) ? $project->lads->last()->total_fine : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Tindakan</th>
                                            <td>{!! !empty($project->lads->last()->action) ? $project->lads->last()->action : '' !!}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Upload</th>
                                            <td></td>
                                        </tr>
                                    </table>
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
@endpush
