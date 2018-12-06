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

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Maklumat Jawatankuasa Rundingan Harga</h3>
                    </div>
                    
                    <div class="box-body">
                        {{ Form::open(['url' => route('committees.update.information.direct', $project_id), 'method' => 'PUT', ' enctype' => 'multipart/form-data']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh Lantikan Jawatan</label>
                                            <input class="form-control pickdate" type="text" name="committee_appointment_date" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Muatnaik Surat Lantikan</label>
                                            <input class="form-control" type="file" name="committee_appointment_letter">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh Mesyuarat</label>
                                            <input class="form-control pickdate" type="text" name="committee_meeting" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Muatnaik Minit Mesyuarat</label>
                                            <input class="form-control" type="file" name="committee_minute_meeting">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 pull-right mrg20T">
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
    <script type="text/javascript">
        $(function () {
            $('.pickdate').datepicker({
                todayHighlight: true,
                autoclose: true
            });
        });
    </script>
@endpush
