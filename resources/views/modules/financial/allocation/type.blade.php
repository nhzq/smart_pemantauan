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
                        <a href="{{ route('allocations.create', $budget->id) }}" class="btn bg-purple">
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
                        <h3 class="box-title">{{ $budget->code . ': ' . $budget->description }}</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Details</th>
                                        <th>Allocation (RM)</th>
                                        <th>Estimate Cost (RM)</th>
                                        <th>Project Cost</th>
                                        <th>Total Spending</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($allocations))
                                        @foreach ($allocations as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->sub->code ?? 'N/A' }}</td>
                                                <td>{{ $data->sub->description }}</td>
                                                <td>{{ $data->amount ?? 'N/A' }}</td>
                                                <td>{{ $data->estimate_cost ?? 'N/A' }}</td>
                                                <td>{{ $data->project_cost ?? 'N/A' }}</td>
                                                <td>{{ $data->total_spending ?? 'N/A' }}</td>
                                                <td>{{ $data->balance ?? 'N/A' }}</td>
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