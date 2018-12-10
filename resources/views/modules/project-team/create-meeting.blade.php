@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/table.css') }}">
@endpush

@section ('content')
    <!-- Content Header (Page header) -->
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Kekerapan Mesyuarat: {{ \App\Models\LookupProjectTeam::where('id', $id)->pluck('name')->first() }}</h3>
                    </div>
                    
                    <div class="box-body">
                        {{ Form::open(['url' => route('project-team.store.meeting', [$project->id, $id]), 'method' => 'POST']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kekerapan Mesyuarat</label>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <select id="team_meeting" class="form-control" name="team_meeting">
                                            <?php $options = [0, 1, 2, 3, 4, 5]; ?>
                                            @foreach ($options as $data)
                                                <option value="{{ $data }}">{{ $data }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div id="team_meeting_list"></div>

                                <div class="row">
                                    <div class="col-md-2 mrg10T mrg10B pull-right">
                                        <button class="btn btn-block btn-primary" type="submit">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@push ('script')
    <script type="text/javascript">
        $('.pickdate').datepicker({
            todayHighlight: true,
            autoclose: true
        });

        $('#team_meeting').on('change', function () {
            total_meeting = $(this).val();
            row = '';

            for ($i = 0; $i < total_meeting; $i++) {
                row += '<div class="row">';
                row += '<div class="col-md-4">';
                row += '<div class="form-group">';
                row += '<label>Tarikh Rancangan Mesyuarat</label>';
                row += '</div>';
                row += '</div>';
                row += '<div class="col-md-8">';
                row += '<div class="form-group">';
                row += '<input class="form-control pickdate" type="text" name="team_meeting_date[]">';
                row += '</div>';
                row += '</div>';
                row += '</div>';
            }

            $('#team_meeting_list').html('');
            $('#team_meeting_list').append(row).find('.pickdate').datepicker({
                todayHighlight: true,
                autoclose: true
            });
        });
    </script>
@endpush
