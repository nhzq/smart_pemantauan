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
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-borderless">
                            <div class="panel-heading panel-dark">
                                Butiran Pelanggan
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered font-std">
                                            <tr class="info">
                                                <th class="col-md-3">&nbsp;</th>
                                                <th>Maklumat Kontraktor</th>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tarikh Surat Setuju Terima (SST)</th>

                                                <?php 
                                                    $sst_date = '';

                                                    if (!empty($project->contractorAppointment->sst)) {
                                                        $sst_date = $project->contractorAppointment->sst->format('d/m/Y');
                                                    }
                                                ?>
                                                <td>{{ $sst_date }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">No. Rujukan SST</th>
                                                <td>{{ $project->contractorAppointment->sst_reference_no ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Harga Kontrak (RM)</th>
                                                <td>{{ currency($project->actual_project_cost) }}</td>
                                            </tr>
                                            <tr class="info">
                                                <th class="col-md-3">&nbsp;</th>
                                                <th>Maklumat Syarikat</th>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">No. Sijil SSM </th>
                                                <td>{{ $project->contractorAppointment->ssm_no ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">No. Rujukan Pendaftaran SSM</th>
                                                <td>{{ $project->contractorAppointment->ssm_reference_no ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tempoh Sah Laku</th>
                                                <?php 
                                                    $ssm_start_date = '';
                                                    $ssm_end_date = '';

                                                    if (!empty($project->contractorAppointment->ssm_start_date)) {
                                                        $ssm_start_date = $project->contractorAppointment->ssm_start_date->format('d/m/Y');
                                                    }

                                                    if (!empty($project->contractorAppointment->ssm_end_date)) {
                                                        $ssm_end_date = $project->contractorAppointment->ssm_end_date->format('d/m/Y');
                                                    }
                                                ?>
                                                <td>{{ $ssm_start_date }} - {{ $ssm_end_date }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">No. Sijil MOF</th>
                                                <td>{{ $project->contractorAppointment->mof_no ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">No. Rujukan Pendaftaran MOF</th>
                                                <td>{{ $project->contractorAppointment->mof_reference_no ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tempoh Sah Laku</th>
                                                <?php 
                                                    $mof_start_date = '';
                                                    $mof_end_date = '';

                                                    if (!empty($project->contractorAppointment->mof_start_date)) {
                                                        $mof_start_date = $project->contractorAppointment->mof_start_date->format('d/m/Y');
                                                    }

                                                    if (!empty($project->contractorAppointment->mof_start_date)) {
                                                        $mof_end_date = $project->contractorAppointment->mof_end_date->format('d/m/Y');
                                                    }
                                                ?>
                                                <td>{{ $mof_start_date }} - {{ $mof_end_date }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Nama Syarikat</th>
                                                <td>{{ $project->contractorAppointment->company_name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Alamat Syarikat</th>
                                                <td>{{ $project->contractorAppointment->company_address ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">No. Telefon</th>
                                                <td>{{ $project->contractorAppointment->company_tel ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">No. Fax</th>
                                                <td>{{ $project->contractorAppointment->company_fax ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Bilangan Kontraktor</th>
                                                <td>{{ count($project->contractors) }}</td>
                                            </tr>
                                            <tr class="info">
                                                <th class="col-md-3">&nbsp;</th>
                                                <th>Senarai Kontraktor</th>
                                            </tr>
                                            @foreach ($project->contractors as $data)
                                                <tr class="danger">
                                                    <th colspan="2" class="tbl-default">Maklumat {{ $loop->iteration }}</th>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3 min100">Nama</th>
                                                    <td>{{ $data->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3 min100">Jawatan</th>
                                                    <td>{{ $data->position }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3 min100">Jawatan</th>
                                                    <td>{{ $data->position }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3 min100">No MyKad</th>
                                                    <td>{{ $data->ic }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3 min100">Email</th>
                                                    <td>{{ $data->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col-md-3 min100">No Telefon</th>
                                                    <td>{{ $data->tel }}</td>
                                                </tr>
                                            @endforeach
                                            <tr class="info">
                                                <th class="col-md-3">&nbsp;</th>
                                                <th>Tempoh Kontrak</th>
                                            </tr>
                                            <tr>
                                                <?php 
                                                    $contract_start_date = '';

                                                    if (!empty($project->contractorAppointment->contract_start_date)) {
                                                        $contract_start_date = $project->contractorAppointment->contract_start_date->format('d/m/Y');
                                                    }
                                                ?>
                                                <th class="col-md-5">Tarikh Mula</th>
                                                <td>{{ $contract_start_date }}</td>
                                            </tr>
                                            <tr>
                                                <?php 
                                                    $contract_end_date = '';

                                                    if (!empty($project->contractorAppointment->contract_end_date)) {
                                                        $contract_end_date = $project->contractorAppointment->contract_end_date->format('d/m/Y');
                                                    }
                                                ?>
                                                <th class="col-md-5">Tarikh Akhir</th>
                                                <td>{{ $contract_end_date }}</td>
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
