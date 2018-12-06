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
                        @if ($project->lookup_collection_type_id != 5)
                            <h3 class="box-title">Jawatankuasa Perolehan</h3>
                        @endif
                        @if ($project->lookup_collection_type_id == 5)
                            <h3 class="box-title">Jawatankuasa Rundingan Harga</h3>
                        @endif
                    </div>
                    
                    <div class="box-body">
                        {{ Form::open(['url' => route('committees.store', $project->id), 'method' => 'POST']) }}
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="item_table">
                                        <tr class="tbl-row-init tbl-default">
                                            @if ($project->lookup_collection_type_id != 5)
                                                <th class="col-sm-3">Jenis Jawatankuasa</th>
                                                <th class="col-sm-3">Nama</th>
                                                <th class="col-sm-2">Jawatan</th>
                                                <th class="col-sm-3">Jabatan</th>
                                                <th class="col-sm-1">
                                                    <button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button>
                                                </th>
                                                <input class="collection_type" type="hidden" value="{{ $project->lookup_collection_type_id ?? '' }}">
                                            @endif

                                            @if ($project->lookup_collection_type_id == 5)
                                                <th class="col-sm-4">Nama</th>
                                                <th class="col-sm-4">Jawatan</th>
                                                <th class="col-sm-3">Jabatan</th>
                                                <th class="col-sm-1">
                                                    <button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button>
                                                </th>
                                                <input class="collection_type" type="hidden" value="{{ $project->lookup_collection_type_id ?? '' }}">
                                            @endif
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
            if ($('.collection_type').val() != 5) {
                $(document).on('click', '.add', function () {
                    var html = '';

                    html += '<tr>';
                    html += '<td><select name="committee_type[]" class="form-control"><option value="0">-- Sila Pilih --</option><?php echo getList(); ?></select></td>';
                    html += '<td><input type="text" name="committee_name[]" class="form-control committee_name" /></td>';
                    html += '<td><input type="text" name="committee_position[]" class="form-control committee_position" /></td>';
                    html += '<td><input type="text" name="committee_department[]" class="form-control committee_department" /></td>';
                    html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';

                    $('#item_table').append(html);
                });
            }

            if ($('.collection_type').val() == 5) {
                $(document).on('click', '.add', function () {
                    var html = '';

                    html += '<tr>';
                    html += '<td><input type="text" name="committee_name[]" class="form-control committee_name" /></td>';
                    html += '<td><input type="text" name="committee_position[]" class="form-control committee_position" /></td>';
                    html += '<td><input type="text" name="committee_department[]" class="form-control committee_department" /></td>';
                    html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';

                    $('#item_table').append(html);
                });
            }

            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endpush
