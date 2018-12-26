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
                        {!! setBudgetTitle($provision->budgetType->code, $provision->budgetType->description) !!}
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['url' => route('allocations.update', [$provision->id, $allocation->id]), 'method' => 'PUT']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Butiran</label>
                                            <select class="form-control" name="budget_sub">
                                                <option value="0">-- Sila Pilih --</option>
                                                @foreach ($budget->subs as $data)
                                                    <?php 
                                                        $selected = '';

                                                        if ($allocation->lookup_sub_budget_type_id == $data->id) {
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                    <option value="{{ $data->id }}" {{ $selected }}>{!! setBudgetTitle($data->code, $data->description, 'no-bold') !!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Peruntukan (RM)</label>
                                            <input class="form-control money-convert" type="text" name="budget_allocation" placeholder="Peruntukan (RM)" value="{{ currency($allocation->amount) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 mrg20B mrg20T pull-right">
                                <button class="btn btn-block btn-primary" type="submit">
                                    Simpan
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
    <script src="{{ asset('adminlte/plugin/maskMoney/jquery.maskMoney.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('.money-convert').maskMoney();
        });
    </script>
@endpush