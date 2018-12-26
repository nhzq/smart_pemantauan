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
                            <table class="table table-hover table-bordered">
                                <thead class="font-p">
                                    <tr class="info">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Kod</th>
                                        <th class="text-center">Butiran</th>
                                        <th class="text-center">Peruntukan &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center">Anggaran Kos &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center">Kos Projek &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center">Jumlah Belanja &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center">Baki Belanja &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="font-std">
                                    @if (!empty($provision))
                                        @foreach ($provision->allocations as $data)
                                            <tr>
                                                <td class="align-center">{{ $loop->iteration }}</td>
                                                <td class="align-center">{{ $data->sub->code ?? '' }}</td>
                                                <td class="align-center">{{ $data->sub->description ?? '' }}</td>
                                                <td class="align-center text-right">{{ currency($data->amount) }}</td>
                                                <td class="align-center text-right">{{ currency($data->projects()->sum('estimate_cost')) }}</td>
                                                <td class="align-center text-right">{{ '0.00' }}</td>
                                                <td class="align-center text-right">{{ '0.00' }}</td>
                                                <td class="align-center text-right">{{ '0.00' }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group-vertical">
                                                        <a href="{{ route('allocations.edit', [$provision->id, $data->id]) }}" class="btn btn-sm bg-purple">
                                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if (count($provision->allocations) > 0)
                                            <tr class="warning">
                                                <td colspan="3" class="text-center font-h6">Jumlah Keseluruhan</td>
                                                <td class="text-right font-h6">{{ currency($provision->allocations()->sum('amount')) }}</td>
                                                <td class="text-right font-h6">{{ currency($total_estimate[0]) }}</td>
                                                <td colspan="4"></td>
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