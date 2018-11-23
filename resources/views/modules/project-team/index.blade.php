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
                <div class="row">
                    <div class="col-md-12">
                        <div class="mrg10B pull-right">
                            <div class="btn-group">
                                <a href="{{ route('project-team.create', $project->id) }}" class="btn bg-purple">
                                    <i class="fa fa-fw fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading with-border panel-header-border-blue">
                        <h3 class="panel-title panel-custom-title">Pasukan Projek</h3>
                        <span class="pull-right">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">Pasukan Projek</a></li>
                                <li><a href="#tab2" data-toggle="tab">Jwt Teknikal</a></li>
                                <li><a href="#tab3" data-toggle="tab">Jwt Pemandu</a></li>
                                <li><a href="#tab4" data-toggle="tab">Jwt Pemantauan Smart Selangor</a></li>
                            </ul>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tr class="tbl-row-init tbl-default">
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Jawatan</th>
                                                <th>Bahagian</th>
                                                <th>Unit</th>
                                                <th>Peranan</th>
                                                <th>Kekerapan Mesyuarat</th>
                                                <th>Tindakan</th>
                                            </tr>
                                            @if (isset($team))
                                                @foreach ($team->where('lookup_project_team_id', 1)->get() as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->name ?? '' }}</td>
                                                        <td>{{ $data->position ?? '' }}</td>
                                                        <td>{{ $data->group ?? '' }}</td>
                                                        <td>{{ $data->unit ?? '' }}</td>
                                                        <td>{{ $data->role->team ?? '' }}</td>
                                                        <td>{{ $data->total_meeting ?? '' }}</td>
                                                        <td>
                                                            <div class="min130">
                                                                <div class="btn-group">
                                                                    <a href="{{ route('project-team.edit', [$project->id, $data->id]) }}" class="btn bg-purple">
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
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tr class="tbl-row-init tbl-default">
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Jawatan</th>
                                                <th>Bahagian</th>
                                                <th>Unit</th>
                                                <th>Peranan</th>
                                                <th>Kekerapan Mesyuarat</th>
                                                <th>Tindakan</th>
                                            </tr>
                                            @if (isset($team))
                                                @foreach ($team->where('lookup_project_team_id', 2)->get() as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->name ?? '' }}</td>
                                                        <td>{{ $data->position ?? '' }}</td>
                                                        <td>{{ $data->group ?? '' }}</td>
                                                        <td>{{ $data->unit ?? '' }}</td>
                                                        <td>{{ $data->role->team ?? '' }}</td>
                                                        <td>{{ $data->total_meeting ?? '' }}</td>
                                                        <td>
                                                            <div class="min130">
                                                                <div class="btn-group">
                                                                    <a href="{{ route('project-team.edit', [$project->id, $data->id]) }}" class="btn bg-purple">
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
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tr class="tbl-row-init tbl-default">
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Jawatan</th>
                                                <th>Bahagian</th>
                                                <th>Unit</th>
                                                <th>Peranan</th>
                                                <th>Kekerapan Mesyuarat</th>
                                                <th>Tindakan</th>
                                            </tr>
                                            @if (isset($team))
                                                @foreach ($team->where('lookup_project_team_id', 3)->get() as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->name ?? '' }}</td>
                                                        <td>{{ $data->position ?? '' }}</td>
                                                        <td>{{ $data->group ?? '' }}</td>
                                                        <td>{{ $data->unit ?? '' }}</td>
                                                        <td>{{ $data->role->team ?? '' }}</td>
                                                        <td>{{ $data->total_meeting ?? '' }}</td>
                                                        <td>
                                                            <div class="min130">
                                                                <div class="btn-group">
                                                                    <a href="{{ route('project-team.edit', [$project->id, $data->id]) }}" class="btn bg-purple">
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
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab4">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tr class="tbl-row-init tbl-default">
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Jawatan</th>
                                                <th>Bahagian</th>
                                                <th>Unit</th>
                                                <th>Peranan</th>
                                                <th>Kekerapan Mesyuarat</th>
                                                <th>Tindakan</th>
                                            </tr>
                                            @if (isset($team))
                                                @foreach ($team->where('lookup_project_team_id', 4)->get() as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->name ?? '' }}</td>
                                                        <td>{{ $data->position ?? '' }}</td>
                                                        <td>{{ $data->group ?? '' }}</td>
                                                        <td>{{ $data->unit ?? '' }}</td>
                                                        <td>{{ $data->role->team ?? '' }}</td>
                                                        <td>{{ $data->total_meeting ?? '' }}</td>
                                                        <td>
                                                            <div class="min130">
                                                                <div class="btn-group">
                                                                    <a href="{{ route('project-team.edit', [$project->id, $data->id]) }}" class="btn bg-purple">
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
