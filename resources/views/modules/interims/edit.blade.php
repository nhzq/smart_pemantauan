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
                        Pembayaran Kontrak
                    </div>

                    <div class="panel-body">
                        {{ Form::open(['url' => route('interims.update', [$project->id, $interim->id]) , 'method' => 'PUT']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis Bayaran</label>
                                            <?php 
                                                $types = [
                                                    'insuran', 'interim', 'bank' 
                                                ];
                                            ?>
                                            <select class="form-control" name="payment_type">
                                                <option value="">-- Sila Pilih --</option>
                                                @foreach ($types as $data)
                                                    <?php   
                                                        $selected = '';

                                                        if (!empty($interim->payment_type)) {
                                                            if ($interim->payment_type == $data) {
                                                                $selected = 'selected';
                                                            }
                                                        }
                                                    ?>
                                                    <option value="{{ $data }}" {{ $selected }}>{{ ucwords($data) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Waran/Voucher/EFT/Cek</label>
                                            <input class="form-control" type="text" name="payment_no" value="{{ $interim->payment_no ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tarikh Bayaran</label>
                                            <?php 
                                                $payment_date = '';

                                                if (!empty($interim->payment_date)) {
                                                    $payment_date = $interim->payment_date->format('d/m/Y');
                                                }
                                            ?>
                                            <input class="form-control pickdate" type="text" name="payment_date" value="{{ $payment_date }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jumlah Bayaran</label>
                                            <input class="form-control money-convert" type="text" name="payment_amount" value="{{ currency($interim->amount) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tujuan Bayaran</label>
                                            <input class="form-control" type="text" name="description" value="{{ $interim->description ?? '' }}">
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

            $('.pickdate').datepicker({
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                autoclose: true
            });
        });
    </script>
@endpush