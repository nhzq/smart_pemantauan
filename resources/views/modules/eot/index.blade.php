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
                                            <a href="{{ route('eot.create', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Kemaskini EOT
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
                                Lanjutan Masa (EOT)
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered font-std">
                                        <tr class="info">
                                            <th class="col-md-1">#</th>
                                            <th>Tarikh dari SST mula</th>
                                            <th>Tarikh Lanjutan Tempoh Akhir</th>
                                            <th>Sebab-sebab</th>
                                            <th>Tindakan</th>
                                        </tr>
                                        <tr>
                                            @if(!empty($project->eots))
                                                @foreach ($project->eots as $data)
                                                    <?php 
                                                        $sst_start = '';
                                                        $extend_date = '';

                                                        if (!empty($project->contractorAppointment->sst)) {
                                                            $sst_start = $project->contractorAppointment->sst->format('m/d/Y');
                                                        }

                                                        if (!empty($data->extend_date)) {
                                                            $extend_date = $data->extend_date->format('m/d/Y');
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $sst_start }}</td>
                                                        <td>{{ $extend_date }}</td>
                                                        <td>{!! $data->reason ?? '' !!}</td>
                                                        <td>{!! $data->action ?? '' !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
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
