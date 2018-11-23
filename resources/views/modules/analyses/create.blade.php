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
                        <h3 class="box-title">Pasukan Pembekal/ Kontraktor Baru</h3>
                    </div>
                    
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jawatan</label>
                                        <input id="analyses_position" class="form-control" type="text" placeholder="Jawatan">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bilangan</label>
                                        <input id="analyses_total" class="form-control" type="number">
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
            {{ Form::open(['url' => route('analyses.store', $project->id), 'method' => 'POST']) }}
                <div class="col-md-12">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr class="tbl-row-init tbl-default">
                                                    <th></th>
                                                    <th>Jawatan</th>
                                                    <th>Bilangan</th>
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
                var position = $("#analyses_position").val();
                var total = $("#analyses_total").val();
                var markup = "";

                markup += "<tr>";
                markup += "<td><input type='checkbox' name='record'></td>";
                markup += "<td>";
                markup += position + "<input type='hidden' name='analyses_position[]' value=" + position + ">";
                markup += "</td>";
                markup += "<td>";
                markup += total + "<input type='hidden' name='analyses_total[]' value=" + total + ">";
                markup += "</td>";
                markup += "</tr>";

                $("table tbody").append(markup);
                $("#analyses_position").val('');
                $("#analyses_total").val('');
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
