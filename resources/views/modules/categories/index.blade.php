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
                        Kategori Bajet
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="font-p">
                                    <tr class="info">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Kod</th>
                                        <th class="text-center">Kategori Bajet</th>
                                        <th class="text-center">Kos Projek</th>
                                        <th class="text-center">Perbelanjaan</th>
                                        <th class="text-center">Peratusan (%)</th>
                                    </tr>
                                </thead>
                                <tbody class="font-std">
                                    @if (!empty($budgets))
                                        @foreach ($budgets as $data)
                                            <tr>
                                                <th class="text-center align-center">{{ $loop->iteration }}</th>
                                                <td class="text-center align-center">{{ $data->code }}</td>
                                                <td class="align-center">
                                                    <a href="">{{ $data->description }}</a>
                                                </td>
                                                <td class="text-center align-center">&nbsp;</td>
                                                <td class="text-center align-center">&nbsp;</td>
                                                <td class="text-center align-center">&nbsp;</td>
                                            </tr>
                                        @endforeach
                                    @endif
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