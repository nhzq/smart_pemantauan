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
                        Bon Perlaksanaan
                    </div>

                    <div class="panel-body">
                        {{ Form::open(['url' => route('bond.store', $project->id) , 'method' => 'POST']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Wang Jaminan Perlaksanaan</label>
                                            <input class="form-control" 
                                                type="text" 
                                                name="guarantee_money" 
                                                value="{{ !empty($project->bond->guarantee_money) ? $project->bond->guarantee_money : '' }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jumlah Pembayaran (RM)</label>
                                            <input class="form-control money-convert" 
                                                type="text" 
                                                name="total_payment" 
                                                value="{{ !empty($project->bond->total_payment) ? currency($project->bond->total_payment) : '' }}"
                                            >
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
    <script>
        $(function () {
            $('.money-convert').maskMoney();
        });
    </script>
@endpush