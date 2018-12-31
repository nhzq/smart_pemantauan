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
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Perakuan Akaun Muktamad
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered font-std">
                                    <thead>
                                        <tr class="info">
                                            <th colspan="2" class="text-center">Perakuan Akaun dan Bayaran Muktamad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="col-sm-3">Peruntukan Pembangunan</th>
                                            <td>{{ $project->created_at->format('Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-sm-3">Maksud</th>
                                            <td>{!! !empty($project->certificate->definition) ? $project->certificate->definition : '' !!}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-sm-3">Butiran</th>
                                            <td>{!! !empty($project->certificate->details) ? $project->certificate->details : '' !!}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="pull-right">
                                    <div class="btn-group">
                                        <a href="{{ route('certificates.edit.account', $project->id) }}" class="btn bg-purple">
                                            Kemaskini Perakauan Akaun
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered font-std">
                                    <thead>
                                        <tr class="info">
                                            <th colspan="3" class="text-center">Maklumat Kontrak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="col-sm-3">Tajuk Kerja</th>
                                            <td colspan="2">{{ $project->contract->title ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-sm-3">Nama Dan Alamat Kontraktor</th>
                                            <td colspan="2">
                                                <ul>
                                                    <li>{{ $project->contractorAppointment->company_name ?? '' }}</li>
                                                    <li>{{ $project->contractorAppointment->company_address ?? '' }}</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="col-sm-3">No Kontrak</th>
                                            <td colspan="2">{{ $project->contract->contract_no ?? '' }}</td>
                                        </tr>
                                        <tr class="warning">
                                            <th colspan="2">Harga Asal Kontrak</th>
                                            <td class="col-sm-3 text-right">{{ 'RM ' . currency($project->actual_project_cost) }}</td>
                                        </tr>
                                        <tr class="warning">
                                            <th colspan="2">Jumlah Bersih Tambahan/ Potongan</th>
                                            <td class="col-sm-3"></td>
                                        </tr>
                                        <tr class="warning">
                                            <th colspan="2">Harga Muktamad Kontrak</th>
                                            <td class="col-sm-3"></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="pull-right">
                                    <div class="btn-group">
                                        <a href="" class="btn bg-purple">
                                            Kemaskini Maklumat Kontrak
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered font-std">
                                    <thead>
                                        <tr class="info">
                                            <th colspan="3" class="text-center">Butiran Jumlah Potongan/ Kurangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Pengakuan Persetujuan Kontraktor ke atas Perakuan Akaun dan Bayaran Muktamad
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-hover table-bordered font-std">
                                        <tr>
                                            <th>Tarikh</th>
                                            <td>{{ !empty($project->certificate->witness_date) ? $project->certificate->witness_date->format('d/m/Y') : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Pegawai</th>
                                            <td>{{ !empty($project->certificate->witness_officer_name) ? $project->certificate->witness_officer_name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Penuh (Saksi)</th>
                                            <td>{{ !empty($project->certificate->witness_name) ? $project->certificate->witness_name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>No MyKad (Saksi)</th>
                                            <td>{{ !empty($project->certificate->witness_ic) ? $project->certificate->witness_ic : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat (Saksi)</th>
                                            <td>{{ !empty($project->certificate->witness_address) ? $project->certificate->witness_address : '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-hover table-bordered font-std">
                                        <tr>
                                            <th>Tarikh</th>
                                            <td>{{ !empty($project->certificate->contractor_date) ? $project->certificate->contractor_date->format('d/m/Y') : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Penuh (Kontraktor)</th>
                                            <td>{{ !empty($project->certificate->contractor_name) ? $project->certificate->contractor_name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>No MyKad (Kontraktor)</th>
                                            <td>{{ !empty($project->certificate->contractor_ic) ? $project->certificate->contractor_ic : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat (Kontraktor)</th>
                                            <td>{{ !empty($project->certificate->contractor_address) ? $project->certificate->contractor_address : '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="pull-right">
                                <div class="btn-group">
                                    <a href="{{ route('certificates.edit.agreement', $project->id) }}" class="btn bg-purple">
                                        Kemaskini Pengakuan Persetujuan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
