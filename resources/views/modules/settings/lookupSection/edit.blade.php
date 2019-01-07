@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
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
                        Kemaskini Seksyen
                    </div>

                    <div class="panel-body">
                        <div class="mrg10T mrg10B">
                            {{ Form::open(['url' => route('sections.update', $section->id), 'method' => 'PUT']) }}
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group {{ $errors->has('section_displayed_name') ? 'has-error' : '' }}">
                                                <label>Nama Paparan</label>
                                                <input class="form-control" type="text" name="section_displayed_name" placeholder="Nama Paparan" value="{{ $section->displayed_name ?? '' }}">
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
        </div>
    </section>
    <!-- /.content -->
@endsection

@push ('script')
@endpush