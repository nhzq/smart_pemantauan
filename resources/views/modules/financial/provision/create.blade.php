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
                    <div class="panel-heading panel-dark">Peruntukan mengikut Kategori Bajet</div>
                    <div class="panel-body">
                        @if (!empty($provision->id))
                            {{ Form::open(['url' => route('provisions.update', $provision->id), 'method' => 'PUT']) }}
                        @else
                            {{ Form::open(['url' => route('provisions.store'), 'method' => 'POST']) }}
                        @endif
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Bajet</label>
                                            <input class="form-control" type="text" value="{{ setBudgetTitle($budget->code, $budget->description, 'no-bold') }}" readonly>
                                            <input class="form-control" type="hidden" name="budget_type" value="{{ $budget->id }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Peruntukan (RM)</label>
                                            <input class="form-control money-convert" 
                                                type="text" name="budget_allocation" 
                                                placeholder="Peruntukan (RM)" 
                                                value="{{ !empty($provision->amount) ? currency($provision->amount) : '' }}">
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