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
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Serahan Projek</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <tr class="tbl-row-init tbl-default">
                                        <th colspan="2" class="text-center">Maklumat</th>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Nama Pegawai</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Jawatan</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh Serahan Projek</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh Penyerahan Projek Secara Rasmi</th>
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
