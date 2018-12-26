@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
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
                    <div class="panel panel-borderless">
                        <div class="panel-body panel-nav">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <a href="{{ route('committees.create', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Jawatankuasa Perolehan
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
                    <div class="panel panel-borderless">
                        <div class="panel-heading panel-dark">
                            Jawatankuasa Perolehan
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
                                            <table class="table table-hover table-bordered font-std">
                                                <tr class="info">
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Jawatan</th>
                                                    <th>Jabatan</th>
                                                    <th>Tindakan</th>
                                                </tr>

                                                <?php $spesifikasiTeknikal = $project->committees()->where('committee_type_id', 1)->get(); ?>
                                                @if (count($spesifikasiTeknikal) > 0)
                                                    @foreach ($spesifikasiTeknikal as $data)
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
                                            <div class="panel-heading bck-dark font-h5 clearfix">
                                                <div class="pull-left" style="padding-top: 7.5px;">Maklumat Jawatankuasa Spesifikasi Teknikal</div>
                                                <div class="pull-right">
                                                    <a href="{{ route('committees.edit.information', [$project->id, 1]) }}" class="btn bg-purple">
                                                        Kemaskini Maklumat
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">

                                                    <?php $info1 = $project->committees_info->where('committee_type_id', 1)->first(); ?>
                                                    <table class="table table-hover table-bordered font-std">
                                                        <tr class="info">
                                                            <th></th>
                                                            <th>Maklumat</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Dokumen Spesifikasi Teknikal dan Harga</th>
                                                            <td class="col-md-6 col-sm-6">

                                                                <?php
                                                                    $doc1 = '';

                                                                    if (!empty($info1)) {
                                                                        if (!empty($info1->project->documents())) {
                                                                            $doc1 = $info1->project->documents()->where('category', 'jawatankuasa-spesifikasi-teknikal')->get();
                                                                        }
                                                                    } 
                                                                ?>
                                                                @if (!empty($doc1))
                                                                    @if (count($doc1) > 0)
                                                                        <a href="{{ route('committees.file.download', [$project->id, $doc1->last()->file_name]) }}">
                                                                            <small class="label bg-maroon"><i class="fa fa-download"></i></small>
                                                                            &nbsp; {{ $doc1->last()->original_name ?? '' }}
                                                                        </a>
                                                                        </br>
                                                                    @endif
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
                                                            <td class="col-md-6 col-sm-6">

                                                                <?php 
                                                                    $doc2 = '';

                                                                    if (!empty($info1)) {
                                                                        if (!empty($info1->project->documents())) {
                                                                            $doc2 = $info1->project->documents()->where('category', 'jawatankuasa-spesifikasi-teknikal-surat-lantikan')->get();
                                                                        }
                                                                    }
                                                                ?>
                                                                @if (!empty($doc2))
                                                                    @if (count($doc2) > 0)
                                                                        <a href="{{ route('committees.file.download', [$project->id, $doc2->last()->file_name]) }}">
                                                                            <small class="label bg-maroon"><i class="fa fa-download"></i></small>
                                                                            &nbsp; {{ $doc2->last()->original_name ?? '' }}
                                                                        </a>
                                                                        </br>
                                                                    @endif
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </td>
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
                                            <table class="table table-hover table-bordered font-std">
                                                <tr class="info">
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Jawatan</th>
                                                    <th>Jabatan</th>
                                                    <th>Tindakan</th>
                                                </tr>

                                                <?php $penilaianTeknikal = $project->committees()->where('committee_type_id', 2)->get(); ?>
                                                @if (count($penilaianTeknikal) > 0)
                                                    @foreach ($penilaianTeknikal as $data)
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
                                            <div class="panel-heading bck-dark font-h5 clearfix">
                                                <div class="pull-left" style="padding-top: 7.5px;">Maklumat Jawatankuasa Penilaian Teknikal</div>
                                                <div class="pull-right">
                                                    <a href="{{ route('committees.edit.information', [$project->id, 2]) }}" class="btn bg-purple">
                                                        Kemaskini Maklumat
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">

                                                    <?php $info2 = $project->committees_info->where('committee_type_id', 2)->first(); ?>
                                                    <table class="table table-hover table-bordered font-std">
                                                        <tr class="info">
                                                            <th></th>
                                                            <th>Maklumat</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Tarikh Lantikan Jawatan Spesifikasi Teknikal</th>
                                                            <td class="col-md-6 col-sm-6">{{ !empty($info2->appointment_date) ? $info2->appointment_date->format('m/d/Y') : '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Dokumen Surat Lantikan</th>
                                                            <td class="col-md-6 col-sm-6">

                                                                <?php 
                                                                    $doc = '';

                                                                    if (!empty($info2)) {
                                                                        if (!empty($info2->project->documents())) {
                                                                            $doc = $info2->project->documents()->where('category', 'jawatankuasa-penilaian-teknikal-surat-lantikan')->get();
                                                                        }
                                                                    }
                                                                ?>
                                                                @if (!empty($doc))
                                                                    @if (count($doc) > 0)
                                                                        <a href="{{ route('committees.file.download', [$project->id, $doc->last()->file_name]) }}">
                                                                            <small class="label bg-maroon"><i class="fa fa-download"></i></small>
                                                                            &nbsp; {{ $doc->last()->original_name ?? '' }}
                                                                        </a>
                                                                        </br>
                                                                    @endif
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </td>
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
                                            <table class="table table-hover table-bordered font-std">
                                                <tr class="info">
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Jawatan</th>
                                                    <th>Jabatan</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                                
                                                <?php $penilaianHarga = $project->committees()->where('committee_type_id', 3)->get(); ?>
                                                @if (count($penilaianHarga) > 0)
                                                    @foreach ($penilaianHarga as $data)
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
                                            <div class="panel-heading bck-dark font-h5 clearfix">
                                                <div class="pull-left" style="padding-top: 7.5px;">Maklumat Jawatankuasa Penilaian Harga</div>
                                                <div class="pull-right">
                                                    <a href="{{ route('committees.edit.information', [$project->id, 3]) }}" class="btn bg-purple">
                                                        Kemaskini Maklumat
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">

                                                    <?php $info3 = $project->committees_info->where('committee_type_id', 3)->first(); ?>
                                                    <table class="table table-hover table-bordered font-std">
                                                        <tr class="info">
                                                            <th></th>
                                                            <th>Maklumat</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Tarikh Lantikan Jawatan Spesifikasi Teknikal</th>
                                                            <td class="col-md-6 col-sm-6">{{ !empty($info3->appointment_date) ? $info3->appointment_date->format('m/d/Y') : '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-6 col-sm-6">Dokumen Surat Lantikan</th>
                                                            <td class="col-md-6 col-sm-6">

                                                                <?php 
                                                                    $doc = '';

                                                                    if (!empty($info3)) {
                                                                        if (!empty($info3->project->documents())) {
                                                                            $doc = $info3->project->documents()->where('category', 'jawatankuasa-penilaian-harga-surat-lantikan')->get();
                                                                        }
                                                                    }
                                                                ?>
                                                                @if (!empty($doc))
                                                                    @if (count($doc) > 0)
                                                                        <a href="{{ route('committees.file.download', [$project->id, $doc->last()->file_name]) }}">
                                                                            <small class="label bg-maroon"><i class="fa fa-download"></i></small>
                                                                            &nbsp; {{ $doc->last()->original_name ?? '' }}
                                                                        </a>
                                                                        </br>
                                                                    @endif
                                                                @else
                                                                    N/A
                                                                @endif
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
                    </div>
                @endif
                
                <!-- Rundingan terus -->
                @if ($project->lookup_collection_type_id == 5)
                    <div class="panel panel-borderless">
                        <div class="panel-heading panel-dark">
                            <h3 class="panel-title panel-custom-title">Jawatankuasa Rundingan Harga</h3>
                        </div>
                        <div class="panel-body">
                            <div class="tab-pane active" id="tab1">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered font-std">
                                            <thead>
                                                <tr class="info">
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
                                                <table class="table table-hover table-bordered font-std">
                                                    <tr class="info">
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
