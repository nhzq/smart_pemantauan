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
                <div class="mrg10B pull-right">
                    <div class="btn-group">
                        <button class="btn bg-purple" data-toggle="collapse" data-target="#search" type=""><i class="fa fa-fw fa-search"></i></button>
                        <a href="{{ route('allocations.create') }}" class="btn bg-purple">
                            <i class="fa fa-fw fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Jenis Bajet</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="custom-row" class="table table-hover table-bordered">
                                <thead>
                                    <tr class="tbl-row-init tbl-default">
                                        <th>Bajet</th>
                                        <th>#</th>
                                        <th>Butiran</th>
                                        <th>Peruntukan (RM)</th>
                                        <th>Anggaran Kos (RM)</th>
                                        <th>Kos Projek</th>
                                        <th>Jumlah Belanja</th>
                                        <th>Baki Belanja</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($allocations))
                                        @foreach ($allocations as $data)
                                            <tr>
                                                <td >{!! setBudgetTitle($data->budget->code, $data->budget->description) !!}</td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="min300">{!! setBudgetTitle($data->sub->code, $data->sub->description) !!}</td>
                                                <td>{{ currency($data->amount) ?? 'N/A' }}</td>
                                                <td>{{ currency($data->amount - $data->balance) ?? 'N/A' }}</td>
                                                <td>{{ currency($data->project_cost) ?? 'N/A' }}</td>
                                                <td>{{ currency($data->total_spending) ?? 'N/A' }}</td>
                                                <td>{{ currency($data->balance) ?? 'N/A' }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('allocations.edit', $data->id) }}" class="btn bg-purple">
                                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                                        </a>
                                                    </div>
                                                </td>
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
    <script src="{{ asset('adminlte/dist/js/rowspanizer.js') }}"></script>
    <script>
        $(function () {
            $("#custom-row").rowspanizer({
                vertical_align: 'middle',
                columns: [0]
            });
        });
    </script>
@endpush