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
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">{{ $budget->code . ': ' . $budget->description }}</h3>
                    </div>

                    <div class="box-body">
                        {{ Form::open(['url' => route('allocations.store', $budget->id), 'method' => 'POST']) }}
                            <input type="hidden" name="budget_department_id" value="{{ $budget->lookup_department_id }}">

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('budget_type') ? 'has-error' : '' }}">
                                            <label>Budget Type</label>
                                            <select class="form-control" name="budget_type">
                                                <option>-- Please Choose --</option>
                                                @foreach ($budget->subs as $data)
                                                    <option value="{{ $data->id }}">{{ $data->code . ' : ' . $data->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('budget_allocation') ? 'has-error' : '' }}">
                                            <label>Allocation (RM)</label>
                                            <input class="form-control" type="text" name="budget_allocation" placeholder="Allocation">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('budget_estimate') ? 'has-error' : '' }}">
                                            <label>Estimate Cost (RM)</label>
                                            <input class="form-control" type="text" name="budget_estimate" placeholder="Estimate Cost">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('budget_project_cost') ? 'has-error' : '' }}">
                                            <label>Project Cost (RM)</label>
                                            <input class="form-control" type="text" name="budget_project_cost" placeholder="Project Cost">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('budget_spending') ? 'has-error' : '' }}">
                                            <label>Total Spending (RM)</label>
                                            <input class="form-control" type="text" name="budget_spending" placeholder="Total Spending">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('budget_balance') ? 'has-error' : '' }}">
                                            <label>Balance (RM)</label>
                                            <input class="form-control" type="text" name="budget_balance" placeholder="Baki Belanja">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 mrg20B mrg20T pull-right">
                                <button class="btn btn-block btn-primary" type="submit">
                                    Save
                                </button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@push ('script')
@endpush