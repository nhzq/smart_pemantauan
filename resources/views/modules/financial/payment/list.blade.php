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
                        Bayaran Kemajuan
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered font-std">
                                <tr class="info">
                                    <th class="text-center" colspan="2">Nama Projek</th>
                                    <th class="text-center">Anggaran Kos (RM)</th>
                                    <th class="text-center">Kos Sebenar (RM)</th>
                                    <th class="text-center">Jumlah Belanja (RM)</th>
                                    <th class="text-center">Baki Belanja (RM)</th>
                                    <th class="text-center">Status Projek</th>
                                    <th></th>
                                </tr>

                                <tr>
                                    <td class="text-center" colspan="2">{{ $project->name }}</td>
                                    <td class="text-right">{{ !empty($project->estimate_cost) ? currency($project->estimate_cost) : '0.00' }}</td>
                                    <td class="text-right">{{ !empty($project->actual_project_cost) ? currency($project->actual_project_cost) : '0.00' }}</td>
                                    {{-- <td>{{ !empty($project->contract->cost) ? currency($project->contract->cost) : '0.00' }}</td> --}}

                                    <?php 
                                        $spending = '0.00';
                                        $balance = '0.00';

                                        if (!empty($project->interims->sum('amount'))) {
                                            $spending = currency($project->interims->sum('amount'));

                                            if (!empty($project->actual_project_cost)) {
                                                $balance = currency($project->actual_project_cost - $project->interims->sum('amount'));
                                            }
                                        }
                                    ?>
                                    <td class="text-right">{{ $spending }}</td>
                                    <td class="text-right">{{ $balance }}</td>
                                    <td class="text-center" colspan="2"></td>
                                </tr>
                            </table>

                            <table class="table table-hover table-bordered font-std">
                                <tr class="info">
                                    <th class="text-center">#</th>
                                    <th class="text-center">Jenis Bayaran</th>
                                    <th class="text-center">No. Waran/Voucher/EFT/CEK</th>
                                    <th class="text-center">Tarikh Bayaran</th>
                                    <th class="text-center">Jumlah Bayaran (RM)</th>
                                    <th class="text-center">Tujuan Bayaran</th>
                                    <th class="text-center">Peratus Bayaran</th>
                                    <th class="text-center">Status Bayaran</th>
                                    <th></th>
                                </tr>
                                @if (!empty($project->interims))
                                    @foreach ($project->interims as $data)
                                        @if (!empty($data->status))
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ucwords($data->payment_type) ?? '' }}</td>
                                                <td>{{ $data->payment_no ?? '' }}</td>

                                                <?php 
                                                    $payment_date = '';
                                                    $amount = '0.00';

                                                    if (!empty($data->payment_date)) {
                                                        $payment_date = $data->payment_date->format('m/d/Y');
                                                    }

                                                    if (!empty($data->amount)) {
                                                        $amount = currency($data->amount);
                                                    }
                                                ?>
                                                <td>{{ $payment_date }}</td>
                                                <td class="text-right">{{ $amount }}</td>
                                                <td>{{ $data->description ?? '' }}</td>

                                                <?php 
                                                    $result = '0';
                                                    $total_cost = $project->actual_project_cost;

                                                    if (!empty($total_cost) && !empty($data->amount)) {
                                                        $result = ($data->amount/$total_cost) * 100;
                                                    }

                                                ?>
                                                <td>{{ number_format($result, 2, '.', '') . '%' }}</td>
                                                <td>
                                                    @if (!empty($data->status))
                                                        @if ($data->status == 1)
                                                            <div class="text-center">
                                                                <span class="label label-default">Dalam Proses</span>
                                                            </div>
                                                        @endif

                                                        @if ($data->status == 2)
                                                            <div class="text-center">
                                                                <span class="label label-success">Telah Dibayar</span>
                                                            </div>
                                                        @endif 
                                                    @endif
                                                </td>
                                                <td class="text-center align-center">
                                                    @if ($data->status == 1)
                                                        <a href="{{ route('payments.approve', [$project->id, $data->id]) }}" class="btn btn-sm bg-purple">
                                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                                        </a>
                                                    @elseif ($data->status == 2)
                                                        <i class="fa fa-check clr-diamond"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
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