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
                        Perakuan Akaun dan Bayaran Muktamad
                    </div>

                    <div class="panel-body">
                        {{ Form::open(['url' => route('certificates.store', $project->id), 'method' => 'POST']) }}
                            <div class="col-md-12">
                                <input type="hidden" name="part" value="1">
                                <div class="form-group">
                                    <label>Maksud</label>
                                    <textarea class="form-control texteditor" 
                                        name="definition" 
                                        cols="30" 
                                        rows="5"
                                    >
                                        {{ !empty($project->certificate->definition) ? $project->certificate->definition : '' }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Butiran</label>
                                    <textarea class="form-control texteditor" 
                                        name="details" 
                                        cols="30" 
                                        rows="5"
                                    >
                                        {{ !empty($project->certificate->details) ? $project->certificate->details : '' }}
                                    </textarea>
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