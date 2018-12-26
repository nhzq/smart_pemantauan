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
                                            <a href="{{ route('results.create', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Keputusan Perolehan
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
                        Keputusan Perolehan
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered font-std">
                                    <tr class="info">
                                        <th colspan="2" class="text-center">Maklumat Keputusan</th>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh Kelulusan</th>
                                        <td>{{ !empty($project->actual_approval_date) ? $project->actual_approval_date : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Minit Mesyuarat Kelulusan</th>
                                        <td>N/A</td>
                                    </tr>
                                    <tr class="info">
                                        <th colspan="2" class="text-center">Butiran Kewangan/ Sumber Pembiayaan</th>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Kos Sebenar Projek</th>
                                        <td>{{ !empty($project->actual_project_cost) ? currency($project->actual_project_cost) : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Peruntukan Semasa (RM)</th>
                                        <td>{{ !empty($project->estimate_cost) ? currency($project->estimate_cost) : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Butiran (Justifikasi Kos Projek Sebenar)</th>
                                        <td>{!! !empty($project->justification) ? $project->justification : '' !!}</td>
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
