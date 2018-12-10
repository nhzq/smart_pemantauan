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
                        <h3 class="box-title">Pasukan Projek</h3>
                    </div>
                    
                    <div class="box-body">
                        {{ Form::open(['url' => route('project-team.store', $project->id), 'method' => 'POST']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Pasukan</label>
                                            <select id="team_type" class="form-control" name="team_type">
                                                <option value="0">-- Sila Pilih --</option>
                                                @foreach ($teams as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Peranan</label>
                                            <select id="team_role" class="form-control" name="team_role">
                                                <option value="0">-- Sila Pilih --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="team_name">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jawatan</label>
                                            <input type="text" class="form-control" name="team_position">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <select class="form-control" name="team_department">
                                                <option value="0">-- Sila Pilih --</option>
                                                @if (!empty($departments))
                                                    @foreach ($departments as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bahagian</label>
                                            <input type="text" class="form-control" name="team_part">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <input type="text" class="form-control" name="team_unit">
                                        </div>
                                    </div>
                                </div>

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

        $('#team_type').on('change', function () {
            var selected_value = $(this).val();
            var type = '';

            $.ajax({
                type: 'GET',
                datatype: 'json',
                url: '{{ route('project-team.create.type') }}',
                data: {
                    'id': selected_value
                },
                success: function (data) {
                    type += '<option>-- Sila Pilih --</option>';

                    for (var i = 0; i < data.length; i++) {
                        type += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }

                    $('#team_role').html(" ");
                    $('#team_role').append(type);
                },
                error: function (xhr, desc, err) {
                    console.log('error');
                }
            });
        });
    </script>
@endpush
