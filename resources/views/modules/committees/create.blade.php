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
                        <h3 class="box-title">Jawatankuasa Perolehan</h3>
                    </div>
                    
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Jawatankuasa</label>
                                        <?php 
                                            $types = [
                                                'Jawatankuasa Spesifikasi Teknikal',
                                                'Jawatankuasa Penilaian Teknikal',
                                                'Jawatankuasa Penilaian Harga'
                                            ];
                                        ?>
                                        <select id="committee_type" class="form-control" name="committee_type">
                                            <option value="0">-- Sila Pilih --</option>
                                            @foreach ($types as $key => $type)
                                                <option value="{{ $key + 1 }}" listname="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input id="committee_name" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jawatan</label>
                                        <input id="committee_position" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input id="committee_department" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="pull-right mrg10B">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary add-row">Tambah</button>
                                    <button type="button" class="btn btn-danger delete-row">Hapus</button>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{ Form::open(['url' => route('committees.store', $project_id), 'method' => 'POST']) }}
                <div class="col-md-12">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class="tbl-row-init tbl-default">
                                                    <th></th>
                                                    <th>Jenis Jawatankuasa</th>
                                                    <th>Nama</th>
                                                    <th>Jawatan</th>
                                                    <th>Jabatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 pull-right">
                    <button class="btn btn-block btn-primary" type="submit">
                        Simpan
                    </button>
                </div>
            {{ Form::close() }}
        </div>
    </section>
    <!-- /.content -->
@endsection

@push ('script')
    <script>
        $(function () {
            $(".add-row").click(function () {
                var type_id = $("#committee_type").find('option:selected').val();
                var type_name = $("#committee_type").find('option:selected').attr('listname');
                var name = $("#committee_name").val();
                var position = $("#committee_position").val();
                var department = $("#committee_department").val();
                var markup = "";

                markup += "<tr>";
                markup += "<td><input type='checkbox' name='record'></td>";
                markup += "<td>";
                markup += type_name + "<input type='hidden' name='committee_type[]' value=" + type_id + ">";
                markup += "</td>";
                markup += "<td>";
                markup += name + "<input type='hidden' name='committee_name[]' value=" + name + ">";
                markup += "</td>";
                markup += "<td>";
                markup += position + "<input type='hidden' name='committee_position[]' value=" + position + ">";
                markup += "</td>";
                markup += "<td>";
                markup += department + "<input type='hidden' name='committee_department[]' value=" + department + ">";
                markup += "</td>";
                markup += "</tr>";

                $("table tbody").append(markup);
                $("#committee_name").val('');
                $("#committee_position").val('');
                $("#committee_department").val('');
            });

            $(".delete-row").click(function () {
                $("table tbody").find('input[name="record"]').each(function () {
                    if ($(this).is(":checked")) {
                        $(this).parents("tr").remove();
                    }
                });
            });
        });
    </script>
@endpush
