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
                        <h3 class="box-title">Pindah Peruntukan</h3>
                    </div>

                    <div class="box-body">
                        {{ Form::open(['url' => route('transfers.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('transfer_approval_date') ? 'has-error' : '' }}">
                                            <label>Tarikh Kelulusan</label>
                                            <input class="form-control pickdate" type="text" name="transfer_approval_date">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('transfer_approval_ref_no') ? 'has-error' : '' }}">
                                            <label>No Rujukan Surat Kelulusan</label>
                                            <input class="form-control" type="text" name="transfer_approval_ref_no">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('transfer_warrant_no') ? 'has-error' : '' }}">
                                            <label>No Warran</label>
                                            <input class="form-control" type="text" name="transfer_warrant_no">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('transfer_warrant_date') ? 'has-error' : '' }}">
                                            <label>Tarikh Warran</label>
                                            <input class="form-control pickdate" type="text" name="transfer_warrant_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <hr>
                                            <strong>Maklumat Semasa</strong>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Dari B01</div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-tip: 5px;">Jenis Bajet</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input class="form-control" type="text" value="{{ setBudgetTitle($subs[0]->budget->code, $subs[0]->budget->description, 'no-bold') }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-tip: 5px;">Butiran</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <select id="sub_from_b01" class="form-control get_sub_list" name="sub_from_b01">
                                                            <option value="0">-- Sila Pilih --</option>
                                                            @foreach ($subs as $data)
                                                                <option value="{{ $data->id }}">{{ setBudgetTitle($data->code, $data->description, 'no-bold') }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-top: 5px;">Jumlah Peruntukan (RM)</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input id="sub_from_b01_total_allocation" origvalue="" class="form-control" type="text" name="" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-top: 5px;">Baki Semasa (RM)</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input id="sub_from_b01_current_balance" class="form-control" type="text" name="" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-top: 5px;">Peruntukan Kemaskini (RM)</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input id="sub_from_b01_update_allocation" class="form-control" type="text" name="" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Ke B01</div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-tip: 5px;">Jenis Bajet</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input class="form-control" type="text" value="{{ setBudgetTitle($subs[0]->budget->code, $subs[0]->budget->description, 'no-bold') }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-tip: 5px;">Butiran</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <select id="sub_to_b01" class="form-control get_sub_list" name="sub_to_b01">
                                                            <option value="0">-- Sila Pilih --</option>
                                                            @foreach ($subs as $data)
                                                                <option value="{{ $data->id }}">{{ setBudgetTitle($data->code, $data->description, 'no-bold') }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-top: 5px;">Jumlah Peruntukan (RM)</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input id="sub_to_b01_total_allocation" class="form-control" type="text" name="" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-top: 5px;">Baki Semasa (RM)</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input id="sub_to_b01_current_balance" class="form-control" type="text" name="" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-top: 5px;">Peruntukan Kemaskini (RM)</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input class="form-control" type="text" name="" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <hr>
                                            <strong>Maklumat Pindah Peruntukan</strong>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('transfer_total_allocation') ? 'has-error' : '' }}">
                                            <label>Jumlah Pindah Peruntukan (RM)</label>
                                            <input class="form-control currency" type="text" name="transfer_total_allocation">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('transfer_verify_allocation') ? 'has-error' : '' }}">
                                            <label>Pengesahan Pindah Peruntukan (RM)</label>
                                            <input class="form-control currency" type="text" name="transfer_verify_allocation">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tujuan Pindah Peruntukan</label>
                                            <textarea class="form-control" cols="30" rows="5" name="transfer_allocation_purpose"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Muat Naik Surat</label>
                                            <input class="form-control" type="file" name="transfer_letter[]" multiple>
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
            $('.currency').maskMoney();
            
            $('.pickdate').datepicker({
                todayHighlight: true,
                autoclose: true
            });

            $('.get_sub_list').on('change', function () {
                panel_id = $(this).attr('id');
                selected_id = $('#' + panel_id).val();

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('transfers.create.type') }}',
                    data: {
                        'id': selected_id
                    },
                    success: function (data) {
                        $('#' + panel_id + '_total_allocation').val(' ');
                        $('#' + panel_id + '_current_balance').val(' ');
                        sub_from_b01_total_allocation

                        if (data.amount > 0) {
                            $('#' + panel_id + '_total_allocation').val(data.amount);
                        } else {
                            $('#' + panel_id + '_total_allocation').val('0.00');
                        }

                        if (data.balance > 0) {
                            $('#' + panel_id + '_current_balance').val(data.balance);
                        } else {
                            $('#' + panel_id + '_current_balance').val('0.00');
                        }
                    },
                    error: function (xhr, desc, err) {
                        console.log('error');
                    }
                });
            });

            $("input[name='transfer_total_allocation']").on('keyup', function () {

            });
        });
    </script>
@endpush