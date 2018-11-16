@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/table.css') }}">
@endpush

@section ('content')
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Update Section</h3>
                    </div>

                    <div class="box-body">
                        <div class="mrg10T mrg10B">
                            {{ Form::open(['url' => route('units.update', $unit->id), 'method' => 'PUT']) }}
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('unit_displayed_name') ? 'has-error' : '' }}">
                                                <label>Displayed Name</label>
                                                <input class="form-control" type="text" name="unit_displayed_name" placeholder="Displayed Name" value="{{ $unit->displayed_name ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('unit_displayed_name') ? 'has-error' : '' }}">
                                                <label>Assign To</label>
                                                <select class="form-control" name="unit_assign_to">
                                                    <option value="0">-- Please Choose --</option>
                                                    @foreach ($sections as $section)
                                                        <?php
                                                            $selected = '';

                                                            if (!is_null($unit->lookup_section_id)) {
                                                                if ($unit->section->id == $section->id) {
                                                                    $selected = 'selected';
                                                                }
                                                            }
                                                        ?>
                                                        <option value="{{ $section->id }}" {{ $selected }}>
                                                            {{ $section->displayed_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 mrg20B mrg20T pull-right">
                                    <button class="btn btn-block btn-primary" type="submit">
                                        Save
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