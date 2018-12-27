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
                                            <a href="{{ route('project-team.create', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Pasukan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhasanyrole

                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Pasukan Projek
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
                                        <table class="table table-hover table-bordered font-std">
                                            <tr class="info">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Jawatan</th>
                                                <th class="text-center">Bahagian</th>
                                                <th class="text-center">Unit</th>
                                                <th class="text-center">Peranan</th>
                                                <th class="col-sm-1"></th>
                                            </tr>
                                            @if (!empty($project->teams))
                                                @foreach ($project->teams->where('lookup_project_team_id', 1) as $data)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td>{{ $data->name ?? '' }}</td>
                                                        <td>{{ $data->position ?? '' }}</td>
                                                        <td>{{ $data->group ?? '' }}</td>
                                                        <td>{{ $data->unit ?? '' }}</td>
                                                        <td>{{ $data->role->name ?? '' }}</td>
                                                        <td class="text-center">
                                                            <div class="min100">
                                                                <div class="btn-group">
                                                                    <a href="{{ route('project-team.edit', [$project->id, $data->id]) }}" class="btn btn-sm bg-purple">
                                                                        <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                    </a>
                                                                    <button class="btn btn-sm btn-danger" type="submit">
                                                                        <i class="fa fa-fw fa-trash-o"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if (count($project->teams->where('lookup_project_team_id', 1)))
                                                <tr class="warning">
                                                    <th colspan="4">Kekerapan Mesyuarat (Jumlah)</th>
                                                    <td colspan="2"><strong>{{ count($project->meetings->where('lookup_project_team_id', 1)) }}</strong></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('project-team.create.meeting', [$project->id, 1]) }}" class="btn btn-diamond">
                                                                Kemaskini
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <tr class="info">
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Jawatan</th>
                                                <th>Bahagian</th>
                                                <th>Unit</th>
                                                <th>Peranan</th>
                                                <th class="col-sm-1"></th>
                                            </tr>
                                            @if (!empty($project->teams))
                                                @foreach ($project->teams->where('lookup_project_team_id', 2) as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->name ?? '' }}</td>
                                                        <td>{{ $data->position ?? '' }}</td>
                                                        <td>{{ $data->group ?? '' }}</td>
                                                        <td>{{ $data->unit ?? '' }}</td>
                                                        <td>{{ $data->role->name ?? '' }}</td>
                                                        <td class="text-center">
                                                            <div class="min100">
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
                                            @if (count($project->teams->where('lookup_project_team_id', 2)) > 0)
                                                <tr class="warning">
                                                    <th colspan="4">Kekerapan Mesyuarat (Jumlah)</th>
                                                    <td colspan="2"><strong>{{ count($project->meetings->where('lookup_project_team_id', 2)) }}</strong></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('project-team.create.meeting', [$project->id, 2]) }}" class="btn btn-diamond">
                                                                Kemaskini
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <tr class="info">
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Jawatan</th>
                                                <th>Bahagian</th>
                                                <th>Unit</th>
                                                <th>Peranan</th>
                                                <th class="col-sm-1"></th>
                                            </tr>
                                            @if (!empty($project->teams))
                                                @foreach ($project->teams->where('lookup_project_team_id', 3) as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->name ?? '' }}</td>
                                                        <td>{{ $data->position ?? '' }}</td>
                                                        <td>{{ $data->group ?? '' }}</td>
                                                        <td>{{ $data->unit ?? '' }}</td>
                                                        <td>{{ $data->role->name ?? '' }}</td>
                                                        <td class="text-center">
                                                            <div class="min100">
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
                                            @if (count($project->teams->where('lookup_project_team_id', 3)))
                                                <tr class="warning">
                                                    <th colspan="4">Kekerapan Mesyuarat (Jumlah)</th>
                                                    <td colspan="2"><strong>{{ count($project->meetings->where('lookup_project_team_id', 3)) }}</strong></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('project-team.create.meeting', [$project->id, 3]) }}" class="btn btn-diamond">
                                                                Kemaskini
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab4">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <tr class="info">
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Jawatan</th>
                                                <th>Bahagian</th>
                                                <th>Unit</th>
                                                <th>Peranan</th>
                                                <th class="col-sm-1"></th>
                                            </tr>
                                            @if (!empty($project->teams))
                                                @foreach ($project->teams->where('lookup_project_team_id', 4) as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->name ?? '' }}</td>
                                                        <td>{{ $data->position ?? '' }}</td>
                                                        <td>{{ $data->group ?? '' }}</td>
                                                        <td>{{ $data->unit ?? '' }}</td>
                                                        <td>{{ $data->role->name ?? '' }}</td>
                                                        <td class="text-center">
                                                            <div class="min100">
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
                                            @if (count($project->teams->where('lookup_project_team_id', 4)))
                                                <tr class="warning">
                                                    <th colspan="4">Kekerapan Mesyuarat (Jumlah)</th>
                                                    <td colspan="2"><strong>{{ count($project->meetings->where('lookup_project_team_id', 4)) }}</strong></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('project-team.create.meeting', [$project->id, 4]) }}" class="btn btn-diamond">
                                                                Kemaskini
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
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
