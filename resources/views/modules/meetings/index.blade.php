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
                                            <a href="{{ route('scopes.create', $project->id) }}" class="btn btn-default">
                                                <i class="fa fa-fw fa-plus"></i> Kemaskini Mesyuarat
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
                                <h3 class="box-title">Mesyuarat</h3>
                            </div>
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Pasukan Projek</div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="col-sm-6">Perkara</th>
                                                                <th class="col-sm-2">Tarikh Jangkaan</th>
                                                                <th class="col-sm-2">Tarikh Sebenar</th>
                                                                <th class="col-sm-2">Minit Mesyuarat</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $pasukanProjek = $project->teams->where('lookup_project_team_id', 1); ?>
                                                            @if (!empty($pasukanProjek))
                                                                @foreach ($pasukanProjek as $data)
                                                                    <?php $meetings = explode('|', $data->meeting_dates); ?>
                                                                    @foreach ($meetings as $meeting)
                                                                        <tr>
                                                                            <td></td>
                                                                            <td>{{ $meeting }}</td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endforeach
                                                            @endif
                                                            <tr>
                                                                <td colspan="4" class="text-center"><strong>Jumlah Mesyuarat: 3/3</strong></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Jawatankuasa Teknikal</div>
                                            <div class="panel-body">Panel Content</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Jawatankuasa Pemandu</div>
                                            <div class="panel-body">Panel Content</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Jawatankuasa Pemantauan Smart Selangor</div>
                                            <div class="panel-body">Panel Content</div>
                                        </div>
                                    </div>
                                    {{-- <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tr class="tbl-row-init tbl-default">
                                                <th class="col-md-3">&nbsp;</th>
                                                <th>Maklumat</th>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Mesyuarat</th>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div> --}}
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
