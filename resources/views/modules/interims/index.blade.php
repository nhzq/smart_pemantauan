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
                                    <table class="table table-hover table-bordered font-p">
                                        <tr class="info">
                                            <th colspan="2">Nama Projek</th>
                                            <th>Anggaran Kos (RM)</th>
                                            <th>Kos Sebenar (RM)</th>
                                            <th>Jumlah Belanja (RM)</th>
                                            <th>Baki Belanja (RM)</th>
                                            <th>Status Projek</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">{{ $project->name }}</td>
                                            <td>{{ !empty($project->estimate_cost) ? currency($project->estimate_cost) : '0.00' }}</td>
                                            <td>{{ !empty($project->contract->cost) ? currency($project->contract->cost) : '0.00' }}</td>

                                            <?php 
                                                $spending = '0.00';
                                                $balance = '0.00';

                                                if (!empty($project->interims->sum('amount'))) {
                                                    $spending = currency($project->interims->sum('amount'));

                                                    if (!empty($project->contract->cost)) {
                                                        $balance = currency($project->contract->cost - $project->interims->sum('amount'));
                                                    }
                                                }
                                            ?>
                                            <td>{{ $spending }}</td>
                                            <td>{{ $balance }}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="info">
                                            <th>#</th>
                                            <th>Jenis Bayaran</th>
                                            <th>No. Waran/Voucher/EFT/CEK</th>
                                            <th>Tarikh Bayaran</th>
                                            <th>Jumlah Bayaran (RM)</th>
                                            <th>Tujuan Bayaran</th>
                                            <th>Peratus Bayaran</th>
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
                                                            $payment_date = $data->payment_date->format('m/d/Y');
                                                        }

                                                        if (!empty($data->amount)) {
                                                            $amount = currency($data->amount);
                                                        }
                                                    ?>
                                                    <td>{{ $payment_date }}</td>
                                                    <td>{{ $amount }}</td>
                                                    <td>{{ $data->description ?? '' }}</td>

                                                    <?php 
                                                        $result = '0';
                                                        $total_cost = $project->contract->cost;

                                                        if (!empty($total_cost) && !empty($data->amount)) {
                                                            $result = ($data->amount/$total_cost) * 100;
                                                        }

                                                    ?>
                                                    <td>{{ $result . '%' }}</td>
                                                    <td></td>
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
