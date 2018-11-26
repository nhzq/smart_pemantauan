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
                        <a href="{{ route('transfers.create') }}" class="btn bg-purple">
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
                        <h3 class="box-title">Pindah Peruntukan</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr class="tbl-row-init tbl-default">
                                        <th>#</th>
                                        <th>Tarikh Kelulusan</th>
                                        <th>Dari B01</th>
                                        <th>Ke B01</th>
                                        <th>No Waran</th>
                                        <th>Tarikh Waran</th>
                                        <th>Tujuan</th>
                                        <th>Jumlah Pindah Peruntukan (RM)</th>
                                        {{-- <th>Tindakan</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($transfers))
                                        @foreach ($transfers as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <?php 
                                                    $date_formatted = '';

                                                    if (!empty($data->approval_date)) {
                                                        $date_formatted = $data->approval_date->format('m/d/Y');
                                                    }
                                                ?>
                                                <td>{{ $date_formatted }}</td>
                                                <td>{!! setBudgetTitle($data->subsFrom->code, $data->subsFrom->description) ?? '' !!}</td>
                                                <td>{!! setBudgetTitle($data->subsTo->code, $data->subsTo->description) ?? '' !!}</td>
                                                <td>{{ $data->warrant_no ?? '' }}</td>
                                                <?php 
                                                    $date_formatted_2 = '';

                                                    if (!empty($data->warrant_date)) {
                                                        $date_formatted_2 = $data->warrant_date->format('m/d/Y');
                                                    }
                                                ?>
                                                <td>{{ $date_formatted_2 }}</td>
                                                <td>{{ $data->purpose ?? '' }}</td>
                                                <td>{{ currency($data->transfer_amount) ?? '' }}</td>
                                                {{-- <td>
                                                    <div class="btn-group">
                                                        <a href="" class="btn bg-purple">
                                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                                        </a>
                                                    </div>
                                                </td> --}}
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