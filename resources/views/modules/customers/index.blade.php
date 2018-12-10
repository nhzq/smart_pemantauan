@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/table.css') }}">
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border panel-header-border-blue">
                                <h3 class="box-title">Butiran Pelanggan</h3>
                            </div>
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tr class="tbl-row-init tbl-default">
                                                <th class="col-md-3">&nbsp;</th>
                                                <th>Maklumat</th>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tarikh Surat Setuju Terima (SST)</th>
                                                <td>{{ $project->contractorAppointment->sst ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">No. Rujukan SST</th>
                                                <td>{{ $project->contractorAppointment->sst_reference_no ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Harga Kontrak (RM)</th>
                                                <td>{{ $project->contractorAppointment->contract_value ?? '' }}</td>
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
                                                <td></td>
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
                                                <td></td>
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
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Nama</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Jawatan</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">No. MyKad</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Emel</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">No. Telefon</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <?php 
                                                    $contract_start_date = '';

                                                    if (!empty($project->contractorAppointment->contract_start_date)) {
                                                        $contract_start_date = $project->contractorAppointment->contract_start_date->format('m/d/Y');
                                                    }
                                                ?>
                                                <th class="col-md-5">Tarikh Mula</th>
                                                <td>{{ $contract_start_date }}</td>
                                            </tr>
                                            <tr>
                                                <?php 
                                                    $contract_end_date = '';

                                                    if (!empty($project->contractorAppointment->contract_end_date)) {
                                                        $contract_end_date = $project->contractorAppointment->contract_end_date->format('m/d/Y');
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
