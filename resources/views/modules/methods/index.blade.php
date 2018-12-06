@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/table.css') }}">
@endpush

@section ('content')
    <!-- Content Header (Page header) -->
    @include('components._breadcrumbs')

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
                                            <a href="{{ route('methods.create', $project->id) }}" class="btn btn-default">
                                                <i class="fa fa-fw fa-plus"></i> Tambah Maklumat Perolehan
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
                        <h3 class="box-title">Kaedah Perolehan</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr class="tbl-row-init tbl-default">
                                        <th class="text-center" colspan="2">Maklumat Perolehan</th>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-5">
                                            @if ($project->lookup_collection_type_id == 2)
                                                No Sebutharga B
                                            @endif
                                            @if ($project->lookup_collection_type_id == 3)
                                                No Sebutharga
                                            @endif
                                            @if ($project->lookup_collection_type_id == 4)
                                                No Tender
                                            @endif
                                        </th>
                                        <td>{{ $project->collection_file_no ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-5">
                                            @if ($project->lookup_collection_type_id == 2)
                                                Tarikh Buka Sebutharga B
                                            @endif
                                            @if ($project->lookup_collection_type_id == 3)
                                                Tarikh Buka Sebutharga
                                            @endif
                                            @if ($project->lookup_collection_type_id == 4)
                                                Tarikh Buka Tender
                                            @endif
                                        </th>
                                        <td>{{ $project->collection_open_date ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-5">
                                            @if ($project->lookup_collection_type_id == 2)
                                                Tarikh Tutup Sebutharga B
                                            @endif
                                            @if ($project->lookup_collection_type_id == 3)
                                                Tarikh Tutup Sebutharga
                                            @endif
                                            @if ($project->lookup_collection_type_id == 4)
                                                Tarikh Tutup Tender
                                            @endif
                                        </th>
                                        <td>{{ $project->collection_close_date ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-5">
                                            @if ($project->lookup_collection_type_id == 2)
                                                Tempoh Sah Tawaran Sebutharga B
                                            @endif
                                            @if ($project->lookup_collection_type_id == 3)
                                                Tempoh Sah Tawaran Sebutharga
                                            @endif
                                            @if ($project->lookup_collection_type_id == 4)
                                                Tempoh Sah Tawaran Tender
                                            @endif
                                        </th>
                                        <td>{{ $project->duration ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-5">
                                            @if ($project->lookup_collection_type_id == 2)
                                                Tarikh Mesyuarat Jawatankuasa Sebutharga B
                                            @endif
                                            @if ($project->lookup_collection_type_id == 3)
                                                Tarikh Mesyuarat Jawatankuasa Sebutharga Pejabat SUK Selangor
                                            @endif
                                            @if ($project->lookup_collection_type_id == 4)
                                                Tarikh Mesyuarat Lembaga Perolehan Negeri
                                            @endif
                                        </th>
                                        <td>{{ $project->collection_meeting_date ?? '' }}</td>
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
