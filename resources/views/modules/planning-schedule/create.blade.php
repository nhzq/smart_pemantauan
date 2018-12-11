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
                        <h3 class="box-title">Jadual Perancangan Projek</h3>
                    </div>
                    
                    <div class="box-body">
                        {{ Form::open(['url' => route('schedules.store', $project->id), 'method' => 'POST']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Nama Aktiviti</label>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="activity">
                                    </div>
                                </div>
                            </div>

                            <p>&nbsp;</p>

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="item_table">
                                        <tr class="tbl-row-init tbl-default">
                                            <th>Sub Aktiviti</th>
                                            <th>Tarikh Mula</th>
                                            <th>Tarikh Siap</th>
                                            <th class="col-sm-1">
                                                <button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button>
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-2 pull-right mrg10T">
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
    <script>
        $(function () {
            $(document).on('click', '.add', function () {
                var html = '';

                html += '<tr>';
                html += '<td><input type="text" name="sub_activity[]" class="form-control item_name" /></td>';
                html += '<td><input type="text" name="start_date[]" class="form-control pickdate" /></td>';
                 html += '<td><input type="text" name="end_date[]" class="form-control pickdate" /></td>';
                html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';

                $('#item_table').append(html).find('.pickdate').datepicker({
                    todayHighlight: true,
                    autoclose: true
                });
            });

            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endpush
