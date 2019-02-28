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
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button class="btn btn-diamond" data-toggle="collapse" data-target="#search" type="">
                                            <i class="fa fa-fw fa-search"></i> Carian
                                        </button>
                                        <a href="{{ route('allocations.create', $provision->id) }}" class="btn btn-diamond">
                                            <i class="fa fa-fw fa-plus"></i> Peruntukan
                                        </a>
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
                        {!! setBudgetTitle($provision->budgetType->code, $provision->budgetType->description) !!}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered font-std">
                                <tr class="danger">
                                    <th class="text-center">Jumlah Peruntukan (RM)</th>
                                    <th class="text-center">Peruntukan Tambahan (RM)</th>
                                    <th class="text-center">Peruntukan Kemaskini (RM)</th>
                                </tr>
                                <tr>
                                    <?php 
                                        $total_provision = !empty($provision->sum('amount')) ? $provision->sum('amount') : 0;
                                        $total_additional_budget = !empty($provision->additionals()) ? $provision->additionals()->sum('extra_budget') : 0;
                                        $sum_of_provision = $total_provision + $total_additional_budget;
                                    ?>
                                    <td class="text-center">{{ currency($provision->sum('amount')) }}</td>
                                    <td class="text-center">{{ !empty($provision->additionals()) ? currency($provision->additionals()->sum('extra_budget')) : '' }}</td>
                                    <th class="text-center">{{ currency($sum_of_provision) }}</th>
                                </tr>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="font-p">
                                    <tr class="info">
                                        <th class="text-center align-center">#</th>
                                        <th class="text-center align-center">Objek <br>Sebagai</th>
                                        <th class="text-center align-center">Butiran</th>
                                        <th class="text-center align-center">Peruntukan <br>(RM)</th>
                                        <th class="text-center align-center" colspan="2">Peruntukan <br>Tambahan (RM)</th>
                                        {{-- <th class="text-center align-center">Pindah Peruntukan <br>- Daripada (RM)</th>
                                        <th class="text-center align-center">Pindah Peruntukan <br>- Ke (RM)</th> --}}
                                        <th class="text-center align-center">Peruntukan <br>Kemaskini (RM)</th>
                                        <th class="text-center align-center">Anggaran <br>Kos (RM)</th>
                                        <th class="text-center align-center">Kos Projek <br>(RM)</th>
                                        <th class="text-center align-center">Jumlah <br>Belanja (RM)</th>
                                        <th class="text-center align-center">Baki <br>Belanja (RM)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="font-std">
                                    @if (!empty($provision))
                                        @foreach ($provision->allocations as $data)
                                            <tr>
                                                <td rowspan="2" class="text-center align-center">{{ $loop->iteration }}</td>
                                                <td rowspan="2" class="text-center align-center">{{ $data->sub->code ?? '' }}</td>
                                                <td rowspan="2" class="align-center">{{ $data->sub->description ?? '' }}</td>
                                                <td rowspan="2" class="align-center text-right">{{ currency($data->amount) }}</td>
                                                @if (!empty($addAllocation->where('allocation_id', $data->id)[0]->extra_budget_from))
                                                    <td class="align-center text-right">{{ $addAllocation->where('allocation_id', $data->id)[0]->extra_budget_from }}</td>
                                                    <td class="align-center text-right">{{ currency($addAllocation->where('allocation_id', $data->id)[0]->extra_budget) }}</td>
                                                @else
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                @endif

                                                <?php 
                                                    $from_transfer = 0;
                                                    $to_transfer = 0;

                                                    if (!empty($data->transfers)) {
                                                        $from_transfer = $data->transfers()
                                                            ->where('from_sub_type_id', $data->lookup_sub_budget_type_id)
                                                            ->where('active', 1)
                                                            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                                            ->sum('transfer_amount');

                                                        $to_transfer = $data->transfers()
                                                            ->where('to_sub_type_id', $data->lookup_sub_budget_type_id)
                                                            ->where('active', 1)
                                                            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                                            ->sum('transfer_amount');
                                                    }
                                                ?>
                                                {{-- <td rowspan="2" class="align-center text-right">{{ '-' . currency($from_transfer) }}</td> --}}
                                                {{-- <td rowspan="2" class="align-center text-right">{{ currency($to_transfer) }}</td> --}}

                                                <?php 
                                                    $extra = !empty($data->extra_budget) ? $data->extra_budget : 0;
                                                    $sum_of_allocation = $data->amount + $extra;

                                                    if (removeMaskMoney($from_transfer) > 0) {
                                                        $sum_of_allocation = $sum_of_allocation - removeMaskMoney($from_transfer);
                                                    }

                                                    if (removeMaskMoney($to_transfer) > 0) {
                                                        $sum_of_allocation = $sum_of_allocation + removeMaskMoney($to_transfer);
                                                    }
                                                ?>
                                                <td rowspan="2" class="align-center text-right">{{ currency($sum_of_allocation) }}</td>
                                                <td rowspan="2" class="align-center text-right">{{ currency($data->projects()->sum('estimate_cost')) }}</td>
                                                <td rowspan="2" class="align-center text-right">{{ '0.00' }}</td>
                                                <td rowspan="2" class="align-center text-right">{{ '0.00' }}</td>
                                                <td rowspan="2" class="align-center text-right">{{ '0.00' }}</td>
                                                <td rowspan="2" class="text-center align-center">
                                                    <div class="btn-group-vertical">
                                                        <a href="{{ route('allocations.edit', [$provision->id, $data->id]) }}" class="btn btn-sm bg-purple">
                                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-center">&nbsp;</td>
                                                <td class="align-center">&nbsp;</td>
                                            </tr>

                                            <?php 
                                                $group_of_sum[] = $sum_of_allocation;
                                                $group_of_total[] = $data->projects()->sum('estimate_cost');
                                                $group_of_allocation[] = $data->amount;
                                                $group_of_extra[] = $data->extra_budget;
                                            ?>
                                        @endforeach

                                        @if (count($provision->allocations) > 0)
                                            <tr class="warning">
                                                <td colspan="2" class="text-center font-h6">Jumlah Keseluruhan</td>
                                                <td class="text-right font-h6">
                                                    {{ !empty(array_sum($group_of_allocation)) ? currency(array_sum($group_of_allocation)) : '' }}
                                                </td>
                                                <td class="text-right">
                                                    {{ !empty(array_sum($group_of_extra)) ? currency(array_sum($group_of_extra)) : '' }}
                                                </td>
                                                <td colspan="2">&nbsp;</td>
                                                <td class="text-right font-h6">
                                                    {{ !empty(array_sum($group_of_sum)) ? currency(array_sum($group_of_sum)) : '' }}
                                                </td>
                                                <td class="text-right font-h6">
                                                    {{ !empty(array_sum($group_of_total)) ? currency(array_sum($group_of_total)) : '' }}
                                                </td>
                                                <td colspan="4">&nbsp;</td>
                                            </tr>
                                        @endif
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