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
                                Butiran Kontrak
                            </div>

                            <?php 
                                $eot = null; 
                                $eot_doc = null;
                                $contract_start = null;

                                if (!empty($project->eots->first())) {
                                    $eot = $project->eots->first();
                                }

                                if (!empty($project->eot_docs)) {
                                    $eot_doc = $project->eot_docs;
                                }

                                if (!empty($project->contractorAppointment)) {
                                    $contract_start = $project->contractorAppointment->contract_start_date;
                                }
                            ?>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered font-std">
                                            <tr class="info">
                                                <th class="col-md-3">&nbsp;</th>
                                                <th>Maklumat</th>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tarikh Permohonan</th>
                                                <td>{{ !empty($eot) ? $eot->application_date->format('d/m/Y') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tarikh Kelulusan EOT</th>
                                                <td>{{ !empty($eot) ? $eot->eot_approval_date->format('d/m/Y') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tarikh Lanjut Tempoh</th>
                                                <td>{{ !empty($eot) ? $eot->extension_date->format('d/m/Y') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tempoh Lanjutan Baru Diluluskan</th>
                                                <td>{{ !empty($eot) ? $eot->extension_date->diffInDays($contract_start) . ' hari' : '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Klausa Perlanjutan (Bulan)</th>
                                                <td>{!! !empty($eot) ? $eot->clause : '' !!}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Surat EOT</th>
                                                <td>
                                                    @if (count($project->eot_docs->where('category', 'surat-eot')) > 0)
                                                        @foreach ($project->eot_docs->where('category', 'surat-eot') as $data)
                                                            <a href="{{ url('storage/projects/' . $project->id . '/eot/surat-eot/' . $data->file_name) }}">
                                                                <small class="label bg-maroon"><i class="fa fa-download"></i></small>
                                                                &nbsp; {{ $data->original_name }}
                                                            </a>
                                                            </br>
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Perjanjian Tambahan</th>
                                                <td>
                                                    @if (count($project->eot_docs->where('category', 'perjanjian')) > 0)
                                                        @foreach ($project->eot_docs->where('category', 'perjanjian') as $data)
                                                            <a href="{{ url('storage/projects/' . $project->id . '/eot/perjanjian/' . $data->file_name) }}">
                                                                <small class="label bg-maroon"><i class="fa fa-download"></i></small>
                                                                &nbsp; {{ $data->original_name }}
                                                            </a>
                                                            </br>
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Catatan</th>
                                                <td>{!! !empty($eot) ? $eot->remarks : '' !!}</td>
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
@endpush
