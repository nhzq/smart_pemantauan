@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endpush

@section ('content')
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Perakuan Akaun Muktamad
                    </div>

                    <div class="panel-body">
                        {{ Form::open(['url' => route('certificates.store', $project->id) , 'method' => 'POST']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <hr>
                                    <div class="font-h5 text-center">Perakuan Akaun dan Bayaran Muktamad</div>
                                    <hr>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Maksud</label>
                                            <input class="form-control" type="text" name="definition">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Butiran</label>
                                            <input class="form-control" type="text" name="details">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <hr>
                                    <div class="font-h5 text-center">Maklumat Kontrak</div>
                                    <hr>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tajuk Kerja</label>
                                            <input class="form-control" type="text" name="officer_position">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh</label>
                                            <input class="form-control pickdate" type="text" name="deliverable_date">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Pegawai</label>
                                            <input class="form-control" type="text" name="officer_position">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Penuh</label>
                                            <input class="form-control" type="text" name="officer_position">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No MyKad</label>
                                            <input class="form-control" type="text" name="officer_position">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input class="form-control" type="text" name="officer_position">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh</label>
                                            <input class="form-control pickdate" type="text" name="official_date">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Penuh</label>
                                            <input class="form-control" type="text" name="officer_position">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No MyKad</label>
                                            <input class="form-control" type="text" name="officer_position">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input class="form-control" type="text" name="officer_position">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh</label>
                                            <input class="form-control pickdate" type="text" name="official_date">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script>
        $(function () {
            $('.texteditor').summernote({
                toolbar: [],
                height: 100
            });

            $('.pickdate').datepicker({
                todayHighlight: true,
                autoclose: true
            });
        });
    </script>
@endpush