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

                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button class="btn btn-diamond" data-toggle="collapse" data-target="#search" type="">
                                            <i class="fa fa-fw fa-search"></i> Carian
                                        </button>
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
                    <div class="panel-heading panel-dark">Peruntukan mengikut Kategori Bajet</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="font-p">
                                    <tr class="info">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Kod</th>
                                        <th class="text-center">Butiran</th>
                                        <th class="text-center">Peruntukan &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center" colspan="2">Peruntukan Tambahan &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center">Anggaran Kos &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center">Kos Projek &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center">Jumlah Belanja &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center">Baki Belanja &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody class="font-std">
                                    @if (!empty($lists))
                                        @foreach ($lists as $data)
                                            <tr>
                                                <?php 
                                                    if (!empty($data->provisions)) {
                                                        $provision = $data->provisions()
                                                            ->where('active', 1)
                                                            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                                            ->first();

                                                        if (!empty($provision)) {
                                                            $total_estimate_cost = $provision->allocations()
                                                                ->where('active', 1)
                                                                ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                                                ->sum('amount');
                                                        }
                                                    }
                                                ?>

                                                <td class="text-center align-center">{{ $loop->iteration }}</td>
                                                <td class="text-cente align-center">{{ $data->code ?? '-' }}</td>
                                                <td class="align-center">
                                                    <a href="{{ !empty($provision) ? route('allocations.index', $provision->id) : '' }}">
                                                        {{ $data->description ?? '' }}
                                                    </a>
                                                </td>
                                                <td class="text-right align-center">
                                                    {{ !empty($provision) ? currency($provision->amount) : '0.00' }}
                                                </td>
                                                <td class="align-center">
                                                    {{ $provision->extra_budget_from ?? '' }}
                                                </td>
                                                <td class="text-right align-center">
                                                    {{ !empty($provision) ? currency($provision->extra_budget) : '0.00' }}
                                                </td>
                                                <td class="text-right align-center">
                                                    {{ !empty($total_estimate_cost) ? currency($total_estimate_cost) : '0.00' }}
                                                </td>
                                                <td class="text-right align-center">
                                                    {{ '0.00' }}
                                                </td>
                                                <td class="text-right align-center">
                                                    {{ '0.00' }}
                                                </td>
                                                <td class="text-right align-center">
                                                    {{ '0.00' }}
                                                </td>
                                                <td>
                                                    <div class="btn-group-vertical">
                                                        <a href="{{ route('provisions.edit', $data->id) }}" class="btn btn-sm bg-purple">
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
    <script src="{{ asset('adminlte/plugin/maskMoney/jquery.maskMoney.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('.money-convert').maskMoney();

            $('.close').on('click', function () {
                $('#category').val(0);
                $('#provision_type').val(0);
                $('#additional_provision').val('');
            });
        });
    </script>
@endpush