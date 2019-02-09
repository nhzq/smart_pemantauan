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
                                            <a href="{{ route('bond.create', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Kemaskini Bon
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
                                Bon Perlaksanaan
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered font-std">
                                        <tr class="info">
                                            <th class="col-md-3">&nbsp;</th>
                                            <th>Maklumat</th>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Wang Jaminan Perlaksanaan</th>
                                            <td>{{ $project->bond->guarantee_money ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Jumlah Pembayaran (RM)</th>
                                            <?php 
                                                $total_payment = '';

                                                if (!empty($project->bond->total_payment)) {
                                                    $total_payment = currency($project->bond->total_payment);
                                                }
                                            ?>
                                            <td>{{ $total_payment }}</td>
                                        </tr>
                                        <tr>
                                            <?php 
                                                $bond_value = '';

                                                if (!empty($project->bond->bond_value)) {
                                                    $bond_value = currency($project->bond->bond_value);
                                                }
                                            ?>
                                            <th class="col-md-5">Nilai Bond (RM)</th>
                                            <td>{{ $bond_value }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Nama Bank</th>
                                            <td>{{ !empty($project->bond->bank_name) ? $project->bond->bank_name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Tarikh Awal</th>
                                            <?php 
                                                $start_date = null;

                                                if (!empty($project->bond->start_date)) {
                                                    $start_date = $project->bond->start_date->format('d/m/Y');
                                                }
                                            ?>
                                            <td>{{ $start_date }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Tarikh Akhir</th>
                                            <?php 
                                                $end_date = null;

                                                if (!empty($project->bond->end_date)) {
                                                    $end_date = $project->bond->end_date->format('d/m/Y');
                                                }
                                            ?>
                                            <td>{{ $end_date }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Tempoh Bond</th>
                                            <?php
                                                $diff = 0;

                                                if (!empty($project->bond->end_date) && !empty($project->bond->start_date)) {
                                                    $diff = $project->bond->end_date->diffInDays($project->bond->start_date);
                                                }
                                            ?>
                                            <td>{{ $diff }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Catatan</th>
                                            <td>{!! $project->bond->notes ?? '' !!}</td>
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
