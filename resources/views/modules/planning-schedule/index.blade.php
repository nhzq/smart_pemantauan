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
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="info">
                                            <th>#</th>
                                            <th>Aktiviti</th>
                                            <th>Tarikh Mula</th>
                                            <th>Tarikh Siap</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($schedules = $project->schedules->where('parent_id', 0)))
                                            @foreach ($schedules as $data)
                                                <tr class="danger">
                                                    <th>{{ $loop->iteration }}</th>
                                                    <th colspan="3">{{ $data->activity ?? '' }}</th>
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
                                                                    $start_date = $sub->start_date->format('m/d/Y');
                                                                }

                                                                if (!empty($sub->end_date)) {
                                                                    $end_date = $sub->end_date->format('m/d/Y');
                                                                }
                                                            ?>
                                                            <td>{{ $start_date ?? '' }}</td>
                                                            <td>{{ $end_date ?? '' }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
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
