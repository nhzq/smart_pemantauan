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
                                            <a href="{{ route('committees.create', $project->id) }}" class="btn btn-default">
                                                <i class="fa fa-fw fa-plus"></i> Tambah Jawatankuasa
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhasanyrole
                
                <!-- Sebutharga, sebutharga B, tender -->
                @if ($project->lookup_collection_type_id != 5)
                    <div class="panel">
                        <div class="panel-heading with-border panel-header-border-blue">
                            <h3 class="panel-title panel-custom-title">Jawatankuasa Perolehan</h3>
                            <span class="pull-right">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li class="active"><a href="#tab1" data-toggle="tab">Jwt Spesifikasi Teknikal</a></li>
                                    <li><a href="#tab2" data-toggle="tab">Jwt Penilaian Teknikal</a></li>
                                    <li><a href="#tab3" data-toggle="tab">Jwt Penilaian Harga</a></li>
                                </ul>
                            </span>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <tr class="tbl-row-init tbl-default">
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Jawatan</th>
                                                    <th>Jabatan</th>
                                                    <th>Tindakan</th>
                                                </tr>

                                                <?php $first = $committee->where('project_id', $project->id)->where('committee_type_id', 1)->get(); ?>
                                                @if (count($first) > 0)
                                                    @foreach ($first as $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data->name ?? '' }}</td>
                                                            <td>{{ $data->position ?? '' }}</td>
                                                            <td>{{ $data->department ?? '' }}</td>
                                                            <td>
                                                                <div class="min130">
                                                                    <div class="btn-group">
                                                                        <a href="" class="btn bg-purple">
                                                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                        </a>
                                                                        <button class="btn btn-danger" type="submit">
                                                                            <i class="fa fa-fw fa-trash-o"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5" class="text-center">Tiada maklumat dijumpai.</td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="background-color: transparent;">
                                                Maklumat Jawatankuasa Spesifikasi Teknikal
                                                <div class="pull-right">
                                                    <a href="{{ route('committees.edit.information', [$project->id, 1]) }}" class="btn-sm bg-purple">
                                                        Kemaskini Maklumat
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <?php $info1 = $project->committees_info->where('committee_type_id', 1)->first(); ?>

                                                    <table class="table table-hover table-bordered">
                                                        <tr class="tbl-row-init tbl-default">
                                                            <th></th>
                                                            <th>Maklumat</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Dokumen Spesifikasi Teknikal dan Harga</th>
                                                            <td class="col-md-6 col-sm-6">
                                                                <?php 
                                                                    !empty($info1) ? $doc1 = $info1->project->documents()->where('category', 'jawatankuasa-spesifikasi-teknikal')->get() : $doc1 = ''; 
                                                                ?>
                                                                
                                                                @if (!empty($doc1))
                                                                    <a href="">
                                                                        <small class="label bg-maroon"><i class="fa fa-download"></i></small>
                                                                        &nbsp; {{ $doc1->last()->original_name ?? '' }}
                                                                    </a>
                                                                    </br>
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Tarikh Lantikan Jawatan Spesifikasi Teknikal</th>
                                                            <td class="col-md-6 col-sm-6">{{ !empty($info1->appointment_date) ? $info1->appointment_date->format('m/d/Y') : ''  }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Dokumen Surat Lantikan</th>
                                                            <td class="col-md-6 col-sm-6"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab2">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <tr class="tbl-row-init tbl-default">
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Jawatan</th>
                                                    <th>Jabatan</th>
                                                    <th>Tindakan</th>
                                                </tr>

                                                <?php $second = $committee->where('project_id', $project->id)->where('committee_type_id', 2)->get(); ?>
                                                @if (count($second) > 0)
                                                    @foreach ($second as $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data->name ?? '' }}</td>
                                                            <td>{{ $data->position ?? '' }}</td>
                                                            <td>{{ $data->department ?? '' }}</td>
                                                            <td>
                                                                <div class="min130">
                                                                    <div class="btn-group">
                                                                        <a href="" class="btn bg-purple">
                                                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                        </a>
                                                                        <button class="btn btn-danger" type="submit">
                                                                            <i class="fa fa-fw fa-trash-o"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5" class="text-center">Tiada maklumat dijumpai.</td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="background-color: transparent;">
                                                Maklumat Jawatankuasa Penilaian Teknikal
                                                <div class="pull-right">
                                                    <a href="{{ route('committees.edit.information', [$project->id, 2]) }}" class="btn-sm bg-purple">
                                                        Kemaskini Maklumat
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <?php $info2 = $project->committees_info->where('committee_type_id', 2)->first(); ?>

                                                    <table class="table table-hover table-bordered">
                                                        <tr class="tbl-row-init tbl-default">
                                                            <th></th>
                                                            <th>Maklumat</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Dokumen Spesifikasi Teknikal dan Harga</th>
                                                            <td class="col-md-6 col-sm-6"></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Tarikh Lantikan Jawatan Spesifikasi Teknikal</th>
                                                            <td class="col-md-6 col-sm-6">{{ !empty($info2->appointment_date) ? $info2->appointment_date->format('m/d/Y') : '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Dokumen Surat Lantikan</th>
                                                            <td class="col-md-6 col-sm-6"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab3">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <tr class="tbl-row-init tbl-default">
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Jawatan</th>
                                                    <th>Jabatan</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                                <?php $third = $committee->where('project_id', $project->id)->where('committee_type_id', 3)->get(); ?>
                                                @if (count($third) > 0)
                                                    @foreach ($third as $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data->name ?? '' }}</td>
                                                            <td>{{ $data->position ?? '' }}</td>
                                                            <td>{{ $data->department ?? '' }}</td>
                                                            <td>
                                                                <div class="min130">
                                                                    <div class="btn-group">
                                                                        <a href="" class="btn bg-purple">
                                                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                        </a>
                                                                        <button class="btn btn-danger" type="submit">
                                                                            <i class="fa fa-fw fa-trash-o"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5" class="text-center">Tiada maklumat dijumpai.</td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="background-color: transparent;">
                                                Maklumat Jawatankuasa Penilaian Harga
                                                <div class="pull-right">
                                                    <a href="{{ route('committees.edit.information', [$project->id, 3]) }}" class="btn-sm bg-purple">
                                                        Kemaskini Maklumat
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <?php $info3 = $project->committees_info->where('committee_type_id', 3)->first(); ?>

                                                    <table class="table table-hover table-bordered">
                                                        <tr class="tbl-row-init tbl-default">
                                                            <th></th>
                                                            <th>Maklumat</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Dokumen Spesifikasi Teknikal dan Harga</th>
                                                            <th class="col-md-6 col-sm-6"></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Tarikh Lantikan Jawatan Spesifikasi Teknikal</th>
                                                            <th class="col-md-6 col-sm-6">{{ !empty($info3->appointment_date) ? $info3->appointment_date->format('m/d/Y') : '' }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Dokumen Surat Lantikan</th>
                                                            <th class="col-md-6 col-sm-6"></th>
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
                @endif
                
                <!-- Rundingan terus -->
                @if ($project->lookup_collection_type_id == 5)
                    <div class="panel">
                        <div class="panel-heading with-border panel-header-border-blue">
                            <h3 class="panel-title panel-custom-title">Jawatankuasa Rundingan Harga</h3>
                        </div>
                        <div class="panel-body">
                            <div class="tab-pane active" id="tab1">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="tbl-row-init tbl-default">
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Jawatan</th>
                                                    <th>Jabatan</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $directNego = $project->where('lookup_collection_type_id', 5)->first(); ?>
                                                @if (!empty($directNego))
                                                    @foreach ($directNego->committees as $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data->name ?? '' }}</td>
                                                            <td>{{ $data->position ?? '' }}</td>
                                                            <td>{{ $data->department ?? '' }}</td>
                                                            <td>
                                                                <div class="min130">
                                                                    <div class="btn-group">
                                                                        <a href="" class="btn bg-purple">
                                                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                        </a>
                                                                        <button class="btn btn-danger" type="submit">
                                                                            <i class="fa fa-fw fa-trash-o"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style="background-color: transparent;">
                                            Maklumat Jawatankuasa Rundingan Harga
                                            <div class="pull-right">
                                                <a href="{{ route('committees.edit.information.direct', $project->id) }}" class="btn-sm bg-purple">
                                                    Kemaskini Maklumat
                                                </a>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered">
                                                    <tr class="tbl-row-init tbl-default">
                                                        <th></th>
                                                        <th>Maklumat</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="col-md-6 col-sm-6">Tarikh Lantikan Jawatan Rundingan Harga</th>
                                                        <td class="col-md-6 col-sm-6"></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="col-md-6 col-sm-6">Dokumen Surat Lantikan</th>
                                                        <td class="col-md-6 col-sm-6"></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="col-md-6 col-sm-6">Tarikh Mesyuarat Rundingan Harga</th>
                                                        <td class="col-md-6 col-sm-6"></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="col-md-6 col-sm-6">Minit Mesyuarat Rundingan Harga</th>
                                                        <td class="col-md-6 col-sm-6">
                                                            <a href="">
                                                                <small class="label bg-maroon"><i class="fa fa-download"></i></small>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
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
