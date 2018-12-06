@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/table.css') }}">
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
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <a href="{{ route('contractors.create', $project->id) }}" class="btn btn-default">
                                                <i class="fa fa-fw fa-plus"></i> Kemaskini Kontraktor
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhasanyrole

                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Maklumat Kontraktor</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <tr class="tbl-row-init tbl-default">
                                        <th colspan="2" class="text-center">Perlantikan Kontraktor</th>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh Surat Setuju Terima (SST)</th>
                                        <td>{{ $project->sst ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">No. Rujukan SST</th>
                                        <td>{{ $project->sst_reference_no ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Harga Kontrak</th>
                                        <td>{{ currency($project->contract_value) ?? '' }}</td>
                                    </tr>

                                    <!-- new row -->
                                    <tr class="tbl-row-init tbl-row-end tbl-default">
                                        <th colspan="2" class="text-center">Maklumat Syarikat</th>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">No Sijil SSM</th>
                                        <td>{{ $project->ssm_no ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">No Rujukan Pendaftaran SSM</th>
                                        <td>{{ $project->ssm_reference_no ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tempoh Sah Laku</th>
                                        <td>{{ $project->ssm_start_date ?? '' }} sehingga {{ $project->ssm_end_date ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">No Sijil MOF</th>
                                        <td>{{ $project->mof_no ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">No Rujukan Pendaftaran MOF</th>
                                        <td>{{ $project->mof_reference_no ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tempoh Sah Laku</th>
                                        <td>{{ $project->mof_start_date ?? '' }} sehingga {{ $project->mof_end_date ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Nama Syarikat</th>
                                        <td>{{ $project->company_name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Alamat Syarikat</th>
                                        <td>{!! $project->company_address ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">No Telefon</th>
                                        <td>{{ $project->company_tel ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">No Fax</th>
                                        <td>{{ $project->company_fax ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Bilangan Kontraktor</th>
                                        <td></td>
                                    </tr>

                                    <!-- new row -->
                                    <tr class="tbl-row-init tbl-row-end tbl-default">
                                        <th colspan="2" class="text-center">Senarai Kontraktor</th>
                                    </tr>
                                    @foreach ($project->contractors as $data)
                                        <tr>
                                            <th colspan="2" class="tbl-default">#{{ $loop->iteration }}</th>
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
                                    
                                    <!-- new row -->
                                    <tr class="tbl-row-init tbl-row-end tbl-default">
                                        <th colspan="2" class="text-center">Tempoh Kontrak</th>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh Mula</th>
                                        <td>{{ $project->contract_start_date ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh Akhir</th>
                                        <td>{{ $project->contract_end_date ?? '' }}</td>
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
