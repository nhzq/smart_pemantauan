@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
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
                                            <a href="{{ route('schedules.create', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Jadual Perancangan Projek
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
                        Jadual Perancangan Projek
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered font-std">
                                    <thead>
                                        <tr class="info">
                                            <th>#</th>
                                            <th>Aktiviti</th>
                                            <th>Tarikh Mula</th>
                                            <th>Tarikh Siap</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($schedules = $project->schedules->where('parent_id', 0)))
                                            @foreach ($schedules as $data)
                                                <tr class="danger">
                                                    <th>{{ $loop->iteration }}</th>
                                                    <th colspan="3">{{ $data->activity ?? '' }}</th>
                                                    <th>
                                                        <button type="button" class="btn btn-sm bg-purple" data-toggle="modal" data-target="#modal-parent-{{ $data->id }}">
                                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                                        </button>
                                                    </th>
                                                </tr>

                                                @if (!empty($subs = $project->schedules->where('parent_id', $data->id)))
                                                    @foreach ($subs as $sub)
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td>{{ $sub->activity ?? '' }}</td>

                                                            <?php
                                                                $start_date = '';
                                                                $end_date = '';

                                                                if (!empty($sub->start_date)) {
                                                                    $start_date = $sub->start_date->format('d/m/Y');
                                                                }

                                                                if (!empty($sub->end_date)) {
                                                                    $end_date = $sub->end_date->format('d/m/Y');
                                                                }
                                                            ?>
                                                            <td>{{ $start_date ?? '' }}</td>
                                                            <td>{{ $end_date ?? '' }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm bg-purple" data-toggle="modal" data-target="#modal-child-{{ $sub->id }}">
                                                                    <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modal-child-{{ $sub->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    {{ Form::open(['url' => route('schedules.update', [$project->id, $sub->id]), 'method' => 'PUT']) }}
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title">Kemaskini Aktiviti</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Akitiviti</label>
                                                                                <input class="form-control" type="text" name="activity" value="{{ $sub->activity ?? '' }}">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Tarikh Mula</label>
                                                                                <input class="form-control pickdate" 
                                                                                    type="text" 
                                                                                    name="start_date" 
                                                                                    value="{{ !empty($sub->start_date) ? $sub->start_date->format('d/m/Y') : '' }}">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>Tarikh Siap</label>
                                                                                <input class="form-control pickdate" 
                                                                                    type="text" 
                                                                                    name="end_date" 
                                                                                    value="{{ !empty($sub->end_date) ? $sub->end_date->format('d/m/Y') : '' }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Kemaskini Maklumat</button>
                                                                        </div>
                                                                    {{ Form::close() }}
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                    @endforeach
                                                @endif
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="modal-parent-{{ $data->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            {{ Form::open(['url' => route('schedules.update', [$project->id, $data->id]), 'method' => 'PUT']) }}
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title">Kemaskini Aktiviti</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>Akitiviti</label>
                                                                        <input class="form-control" type="text" name="activity" value="{{ $data->activity ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Kemaskini Maklumat</button>
                                                                </div>
                                                            {{ Form::close() }}
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
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
                format: 'dd/mm/yyyy',
                autoclose: true
            });
        });
    </script>
@endpush
