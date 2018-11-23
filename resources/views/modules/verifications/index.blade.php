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

        @include ('components._phases')

        <div class="row">
            @include ('components._menu')

            <div class="col-md-9">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Pengesahan</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-horizontal">
                                    {{ Form::open(['url' => '', 'method' => 'POST']) }}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label class="col-sm-3 control-label">Nama Pegawai </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="verification_name" value="{{ \Auth::user()->name }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label class="col-sm-3 control-label">Jawatan Pegawai</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" name="verification_position" value="{{ implode((\Auth::user()->roles->pluck('displayed_name')->toArray()), ', ') }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label class="col-sm-3 control-label">Tarikh Pengesahan</label>
                                                <div class="col-sm-9">
                                                    <input class="pickdate form-control" type="text" name="verification_date" placeholder="Tarikh">
                                                </div>
                                            </div>

                                            <div class="col-md-2 mrg20B mrg20T pull-right">
                                                <button class="btn btn-block btn-primary" type="submit">
                                                    Hantar
                                                </button>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
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
        $('.pickdate').datepicker({
            autoclose: true
        });
    </script>
@endpush
