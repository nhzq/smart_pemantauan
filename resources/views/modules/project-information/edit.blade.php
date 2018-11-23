@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
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
                        <h3 class="box-title">Kemaskini Projek</h3>
                    </div>
                    <div class="box-body">
                        {{ Form::open(['url' => route('info.update', $project->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('info_objective_project') ? 'has-error' : '' }}">
                                            <label>Objektif Projek</label>
                                            <textarea class="form-control" name="info_objective_project" cols="30" rows="5">{{ $project->objective ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('info_date_approval_minute') ? 'has-error' : '' }}">
                                            <label>Tarikh Kelulusan Minit Bebas</label>
                                            <input type="text" class="form-control pickdate" name="info_date_approval_minute" value="{{ $project->minute_approval_date->format('m/d/Y') ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Minit Bebas</label>
                                            <input type="file" name="info_minute">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('info_date_approval_pwn') ? 'has-error' : '' }}">
                                            <label>Tarikh Kelulusan PWN</label>
                                            <input type="text" class="form-control pickdate" name="info_date_approval_pwn" value="{{ $project->approval_pwn_date->format('m/d/Y') ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Surat Kelulusan PWN</label>
                                            <input type="file" name="info_approval_pwn">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('info_collection_types') ? 'has-error' : '' }}">
                                            <label>Jenis Perolehan</label>
                                            <select class="form-control" name="info_collection_types">
                                                <option value="0">-- Sila Pilih --</option>
                                                @foreach ($collections as $data)
                                                    <?php 
                                                        $selected = '';

                                                        if ($data->id == $project->lookup_collection_type_id) {
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                    <option value="{{ $data->id }}" {{ $selected }}>{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2 mrg20B mrg20T pull-right">
                                <button class="btn btn-block btn-primary" type="submit">
                                    Simpan
                                </button>
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
    <script src="{{ asset('adminlte/plugin/maskMoney/jquery.maskMoney.min.js') }}" type="text/javascript"></script>
    <script>
        $('.pickdate').datepicker({
            autoclose: true
        });
    </script>

@endpush
