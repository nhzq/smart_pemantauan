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
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Mesyuarat
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
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-4">Perkara</th>
                                                    <th class="col-sm-2">Tarikh Jangkaan</th>
                                                    <th class="col-sm-2">Tarikh Sebenar</th>
                                                    <th class="col-sm-3">Minit Mesyuarat</th>
                                                    <th class="col-sm-1">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $pasukanProjek = $project->meetings->where('lookup_project_team_id', 1); ?>
                                                @if (!empty($pasukanProjek))
                                                    <?php $i = 1; ?>
                                                    @foreach ($pasukanProjek as $data)
                                                        <tr>
                                                            <?php 
                                                                if (!empty($data->meeting_agenda)) {
                                                                    $meeting = 'Mesyuarat ' . $i . '(' . $data->meeting_agenda . ')';
                                                                } else {
                                                                    $meeting =  'Mesyuarat ' . $i;
                                                                }

                                                                $plan_date = '';
                                                                $actual_date = '';

                                                                if (!empty($data->plan_meeting_dates)) {
                                                                    $plan_date = $data->plan_meeting_dates->format('m/d/Y');
                                                                }

                                                                if (!empty($data->actual_meeting_dates)) {
                                                                    $actual_date = $data->actual_meeting_dates->format('m/d/Y');
                                                                }
                                                            ?>
                                                            <td>{{ $meeting }}</td>
                                                            <td>{{ $plan_date }}</td>
                                                            <td>{{ $actual_date }}</td>
                                                            <td>
                                                                <a href="{{ url('storage/projects/' . $project->id . '/minute-meetings/' . $data->file_name) }}">
                                                                    {{ $data->original_name ?? '' }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn bg-purple" data-toggle="modal" data-target="#modal-default-{{ $data->id }}">
                                                                        <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="modal-default-{{ $data->id }}">
                                                            <div class="modal-dialog">
                                                                {{ Form::open([
                                                                    'url' => route('meetings.update.actual', [$project->id, $data->id]), 
                                                                    'method' => 'PUT', 
                                                                    'enctype' => 'multipart/form-data']) 
                                                                }}
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title">Kemaskini Mesyuarat</h4>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Tarikh Sebenar</label>
                                                                                <input type="text" name="actual_date" class="form-control pickdate">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Minit Mesyuarat</label>
                                                                                <input type="file" name="minute_meeting" class="form-control">
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                {{ Form::close() }}
                                                                <!-- /.modal-content -->
                                                            </div>
                                                        </div>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                @endif
                                                <tr>
                                                    <?php 
                                                        $actual_meeting_count = $pasukanProjek->where('actual_meeting_dates', '!=', null)->count();
                                                    ?>
                                                    <td colspan="4" class="text-center"><strong>Jumlah Mesyuarat: {{ $actual_meeting_count . '/' . count($pasukanProjek) }}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab2">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-4">Perkara</th>
                                                    <th class="col-sm-2">Tarikh Jangkaan</th>
                                                    <th class="col-sm-2">Tarikh Sebenar</th>
                                                    <th class="col-sm-3">Minit Mesyuarat</th>
                                                    <th class="col-sm-1">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $jTeknikal = $project->meetings->where('lookup_project_team_id', 2); ?>
                                                @if (!empty($jTeknikal))
                                                    <?php $i = 1; ?>
                                                    @foreach ($jTeknikal as $data)
                                                        <tr>
                                                            <?php 
                                                                if (!empty($data->meeting_agenda)) {
                                                                    $meeting = 'Mesyuarat ' . $i . '(' . $data->meeting_agenda . ')';
                                                                } else {
                                                                    $meeting =  'Mesyuarat ' . $i;
                                                                }

                                                                $plan_date = '';
                                                                $actual_date = '';

                                                                if (!empty($data->plan_meeting_dates)) {
                                                                    $plan_date = $data->plan_meeting_dates->format('m/d/Y');
                                                                }

                                                                if (!empty($data->actual_meeting_dates)) {
                                                                    $actual_date = $data->actual_meeting_dates->format('m/d/Y');
                                                                }
                                                            ?>
                                                            <td>{{ $meeting }}</td>
                                                            <td>{{ $plan_date }}</td>
                                                            <td>{{ $actual_date }}</td>
                                                            <td>
                                                                <a href="{{ url('storage/projects/' . $project->id . '/minute-meetings/' . $data->file_name) }}">
                                                                    {{ $data->original_name ?? '' }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn bg-purple" data-toggle="modal" data-target="#modal-default-{{ $data->id }}">
                                                                        <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="modal-default-{{ $data->id }}">
                                                            <div class="modal-dialog">
                                                                {{ Form::open([
                                                                    'url' => route('meetings.update.actual', [$project->id, $data->id]), 
                                                                    'method' => 'PUT', 
                                                                    'enctype' => 'multipart/form-data']) 
                                                                }}
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title">Kemaskini Mesyuarat</h4>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Tarikh Sebenar</label>
                                                                                <input type="text" name="actual_date" class="form-control pickdate">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Minit Mesyuarat</label>
                                                                                <input type="file" name="minute_meeting" class="form-control">
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                {{ Form::close() }}
                                                                <!-- /.modal-content -->
                                                            </div>
                                                        </div>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                @endif
                                                <tr>
                                                    <?php 
                                                        $actual_meeting_count = $jTeknikal->where('actual_meeting_dates', '!=', null)->count();
                                                    ?>
                                                    <td colspan="4" class="text-center"><strong>Jumlah Mesyuarat: {{ $actual_meeting_count . '/' . count($jTeknikal) }}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab3">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-4">Perkara</th>
                                                    <th class="col-sm-2">Tarikh Jangkaan</th>
                                                    <th class="col-sm-2">Tarikh Sebenar</th>
                                                    <th class="col-sm-3">Minit Mesyuarat</th>
                                                    <th class="col-sm-1">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $jPemandu = $project->meetings->where('lookup_project_team_id', 3); ?>
                                                @if (!empty($jPemandu))
                                                    <?php $i = 1; ?>
                                                    @foreach ($jPemandu as $data)
                                                        <tr>
                                                            <?php 
                                                                if (!empty($data->meeting_agenda)) {
                                                                    $meeting = 'Mesyuarat ' . $i . '(' . $data->meeting_agenda . ')';
                                                                } else {
                                                                    $meeting =  'Mesyuarat ' . $i;
                                                                }

                                                                $plan_date = '';
                                                                $actual_date = '';

                                                                if (!empty($data->plan_meeting_dates)) {
                                                                    $plan_date = $data->plan_meeting_dates->format('m/d/Y');
                                                                }

                                                                if (!empty($data->actual_meeting_dates)) {
                                                                    $actual_date = $data->actual_meeting_dates->format('m/d/Y');
                                                                }
                                                            ?>
                                                            <td>{{ $meeting }}</td>
                                                            <td>{{ $plan_date }}</td>
                                                            <td>{{ $actual_date }}</td>
                                                            <td>
                                                                <a href="{{ url('storage/projects/' . $project->id . '/minute-meetings/' . $data->file_name) }}">
                                                                    {{ $data->original_name ?? '' }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn bg-purple" data-toggle="modal" data-target="#modal-default-{{ $data->id }}">
                                                                        <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="modal-default-{{ $data->id }}">
                                                            <div class="modal-dialog">
                                                                {{ Form::open([
                                                                    'url' => route('meetings.update.actual', [$project->id, $data->id]), 
                                                                    'method' => 'PUT', 
                                                                    'enctype' => 'multipart/form-data']) 
                                                                }}
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title">Kemaskini Mesyuarat</h4>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Tarikh Sebenar</label>
                                                                                <input type="text" name="actual_date" class="form-control pickdate">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Minit Mesyuarat</label>
                                                                                <input type="file" name="minute_meeting" class="form-control">
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                {{ Form::close() }}
                                                                <!-- /.modal-content -->
                                                            </div>
                                                        </div>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                @endif
                                                <tr>
                                                    <?php 
                                                        $actual_meeting_count = $jPemandu->where('actual_meeting_dates', '!=', null)->count();
                                                    ?>
                                                    <td colspan="4" class="text-center"><strong>Jumlah Mesyuarat: {{ $actual_meeting_count . '/' . count($jPemandu) }}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab4">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-4">Perkara</th>
                                                    <th class="col-sm-2">Tarikh Jangkaan</th>
                                                    <th class="col-sm-2">Tarikh Sebenar</th>
                                                    <th class="col-sm-3">Minit Mesyuarat</th>
                                                    <th class="col-sm-1">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $jPemantauan = $project->meetings->where('lookup_project_team_id', 4); ?>
                                                @if (!empty($jPemantauan))
                                                    <?php $i = 1; ?>
                                                    @foreach ($jPemantauan as $data)
                                                        <tr>
                                                            <?php 
                                                                if (!empty($data->meeting_agenda)) {
                                                                    $meeting = 'Mesyuarat ' . $i . '(' . $data->meeting_agenda . ')';
                                                                } else {
                                                                    $meeting =  'Mesyuarat ' . $i;
                                                                }

                                                                $plan_date = '';
                                                                $actual_date = '';

                                                                if (!empty($data->plan_meeting_dates)) {
                                                                    $plan_date = $data->plan_meeting_dates->format('m/d/Y');
                                                                }

                                                                if (!empty($data->actual_meeting_dates)) {
                                                                    $actual_date = $data->actual_meeting_dates->format('m/d/Y');
                                                                }
                                                            ?>
                                                            <td>{{ $meeting }}</td>
                                                            <td>{{ $plan_date }}</td>
                                                            <td>{{ $actual_date }}</td>
                                                            <td>
                                                                <a href="{{ url('storage/projects/' . $project->id . '/minute-meetings/' . $data->file_name) }}">
                                                                    {{ $data->original_name ?? '' }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn bg-purple" data-toggle="modal" data-target="#modal-default-{{ $data->id }}">
                                                                        <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="modal-default-{{ $data->id }}">
                                                            <div class="modal-dialog">
                                                                {{ Form::open([
                                                                    'url' => route('meetings.update.actual', [$project->id, $data->id]), 
                                                                    'method' => 'PUT', 
                                                                    'enctype' => 'multipart/form-data']) 
                                                                }}
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title">Kemaskini Mesyuarat</h4>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Tarikh Sebenar</label>
                                                                                <input type="text" name="actual_date" class="form-control pickdate">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Minit Mesyuarat</label>
                                                                                <input type="file" name="minute_meeting" class="form-control">
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                {{ Form::close() }}
                                                                <!-- /.modal-content -->
                                                            </div>
                                                        </div>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                @endif
                                                <tr>
                                                    <?php 
                                                        $actual_meeting_count = $jPemantauan->where('actual_meeting_dates', '!=', null)->count();
                                                    ?>
                                                    <td colspan="4" class="text-center"><strong>Jumlah Mesyuarat: {{ $actual_meeting_count . '/' . count($jPemantauan) }}</strong></td>
                                                </tr>
                                            </tbody>
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
            $('.pickdate').datepicker({
                todayHighlight: true,
                autoclose: true
            });
        });
    </script>

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
