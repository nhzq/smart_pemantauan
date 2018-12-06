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
                                            <a href="{{ route('contracts.create', $project->id) }}" class="btn btn-default">
                                                <i class="fa fa-fw fa-plus"></i> Butiran Kontrak
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
                                <h3 class="box-title">Butiran Kontrak</h3>
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
                                                <th class="col-md-5">Tajuk Kontrak</th>
                                                <td>Projek Pembangunan Server Cloud</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Kos Kontrak (RM)</th>
                                                <td>2,000,000</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">No Kontrak</th>
                                                <td>123</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tarikh Perjanjian Kontrak</th>
                                                <td>11/11/2019</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tarikh Mula Projek</th>
                                                <td>11/12/2020</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tarikh Siap Projek</th>
                                                <td>12/11/2022</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tarikh Semakan Kontrak Kepada PUU</th>
                                                <td>12/12/2019</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tarikh Terimaan Kontrak Kepada PUU</th>
                                                <td>12/12/2019</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Tempoh Semakan PUU</th>
                                                <td>2 Tahun</td>
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
    <script>
        $(function () {
            var hash = document.location.hash;
            var prefix = "tab_";
            if (hash) {
                $('.panel-tabs a[href="'+hash.replace(prefix,"")+'"]').tab('show');
            } 

            // Change hash for page-reload
            $('.panel-tabs a').on('shown.bs.tab', function (e) {
                window.location.hash = e.target.hash.replace("#", "#" + prefix);
            });
        });
    </script>
@endpush
