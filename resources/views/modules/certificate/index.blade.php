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
                                            <a href="{{ route('certificates.create', $project->id) }}" class="btn btn-default">
                                                <i class="fa fa-fw fa-plus"></i> Perakuan Akaun Muktamad
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
                        <h3 class="box-title">Perakuan Akaun Muktamad</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <tr class="tbl-row-init tbl-default">
                                        <th colspan="2" class="text-center">Maklumat</th>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Peruntukan Pembangunan</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Maksud</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Butiran</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tajuk Kerja</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Maklumat Kontraktor</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">No Kontrak</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Harga Asal Kontrak</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Jumlah Bersih Tambahan/ Potongan</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Harga Muktamad Kontrak</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Butiran Jumlah Potongan/ Kurangan</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Bayaran Muktamad dibawah Kontrak</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Nama Pegawai</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Nama Penuh</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">No MyKad</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Alamat</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Nama Penuh</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">No MyKad</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Alamat</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh</th>
                                        <td></td>
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
