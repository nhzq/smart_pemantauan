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
                                            <a href="{{ route('deliverables.create', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Serahan Projek
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhasanyrole

                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Serahan Projek
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered font-std">
                                    <tr class="info">
                                        <th colspan="2" class="text-center">Maklumat</th>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Nama Pegawai</th>
                                        <td>{{ $project->deliver->officer_name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Jawatan</th>
                                        <td>{{ $project->deliver->position ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh Serahan Projek</th>
                                        <?php 
                                            $deliverable_date = '';

                                            if (!empty($project->deliver->deliverable_date)) {
                                                $deliverable_date = $project->deliver->deliverable_date->format('m/d/Y');
                                            }
                                        ?>
                                        <td>{{ $deliverable_date }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh Penyerahan Projek Secara Rasmi</th>
                                        <?php 
                                            $official_date = '';

                                            if (!empty($project->deliver->official_deliverable_date)) {
                                                $official_date = $project->deliver->official_deliverable_date->format('m/d/Y');
                                            }
                                        ?>
                                        <td>{{ $official_date }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
