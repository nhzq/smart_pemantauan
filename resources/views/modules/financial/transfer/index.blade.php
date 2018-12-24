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
                <div class="panel panel-borderless">
                    <div class="panel-body panel-nav">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-sm-2" style="padding-left: 0;">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <select class="form-control">
                                            <option>2018</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Pindah Peruntukan
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="font-p">
                                    <tr>
                                        <th class="text-center col-sm-1">#</th>
                                        <th class="text-center">Butiran</th>
                                        <th class="text-center">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="font-std">
                                    <tr>
                                        <th class="text-center">1</th>
                                        <td>
                                            <a href="{{ route('transfers.index') }}">Pindah Peruntukan untuk BAPK</a>
                                        </td>
                                        <td>
                                            Pindah Peruntukan bagi setiap perbelanjaan di antara BAPK, di dalam Kategori B01.
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">2</th>
                                        <td>
                                            <a href="{{ route('bspk.transfers.index') }}">Pindah Peruntukan untuk BSPK</a>
                                        </td>
                                        <td>
                                            Pindah Peruntukan bagi setiap perbelanjaan di antara BSPK.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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