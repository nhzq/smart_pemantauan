@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
@endpush

@section ('content')
    <!-- Content Header (Page header) -->
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        @include ('components._phases')

        <div class="row">
            @include ('components._menu')

            <div class="col-md-9">
                @hasanyrole ('ku')
                    <div class="panel panel-borderless">
                        <div class="panel-body panel-nav">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <a href="{{ route('interims.create', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Pembayaran Kontrak
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhasanyrole
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-borderless">
                            <div class="panel-heading panel-dark">
                                Pembayaran Kontrak
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
                                            <th></th>
                                        </tr>
                                        @if (!empty($project->interims))
                                            @foreach ($project->interims as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ ucwords($data->payment_type) ?? '' }}</td>
                                                    <td>{{ $data->payment_no ?? '' }}</td>

                                                    <?php 
                                                        $payment_date = '';
                                                        $amount = '0.00';

                                                        if (!empty($data->payment_date)) {
                                                            $payment_date = $data->payment_date->format('d/m/Y');
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
                                                    <td class="text-center align-center">
                                                        @if (empty($data->status))
                                                            <div class="btn-group-vertical">
                                                                <a href="{{ route('interims.edit', [$project->id, $data->id]) }}" class="btn btn-sm bg-purple">
                                                                    <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                </a>
                                                                <a href="{{ route('interims.notify', [$project->id, $data->id]) }}" class="btn btn-sm bg-purple">
                                                                    <i class="fa fa-paper-plane"></i>
                                                                </a>
                                                            </div>
                                                        @elseif ($data->status == 2)
                                                            <i class="fa fa-check clr-diamond"></i>
                                                        @else
                                                            <i class="fa fa-clock-o clr-diamond"></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push ('script')
@endpush
