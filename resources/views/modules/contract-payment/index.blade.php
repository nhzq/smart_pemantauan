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
                @hasanyrole ('ku')
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <a href="{{ route('payments.create', $project->id) }}" class="btn btn-default">
                                                <i class="fa fa-fw fa-plus"></i> Kemaskini Pembayaran Kontrak
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
                        <div class="box box-solid">
                            <div class="box-header with-border panel-header-border-blue">
                                <h3 class="box-title">Pembayaran Kontrak</h3>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <tr class="tbl-row-init tbl-default">
                                            <th class="col-md-3">&nbsp;</th>
                                            <th>Maklumat</th>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Nama BSPK</th>
                                            <td>{{ $project->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Anggaran Kos(RM)</th>
                                            <td>{{ currency($project->estimate_cost) ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Kos Sebenar (RM)</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Jumlah Belanja (RM)</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Baki Belanja (RM)</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Status Projek</th>
                                            <td></td>
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
