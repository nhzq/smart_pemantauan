@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
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
                        Pindah Peruntukan
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
                                            <div class="panel-heading bck-diamond font-h5">Dari B01</div>
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
                                            <div class="panel-heading bck-diamond font-h5">Ke B01</div>
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
                                                        <input id="sub_to_b01_update_allocation" class="form-control" type="text" name="" readonly>
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
                                            <input id="transfer_total_allocation" class="form-control currency" type="text" name="transfer_total_allocation">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('transfer_verify_allocation') ? 'has-error' : '' }}">
                                            <label>Pengesahan Pindah Peruntukan (RM)</label>
                                            <input id="transfer_verify_allocation" class="form-control currency" type="text" name="transfer_verify_allocation">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tujuan Pindah Peruntukan</label>
                                            <textarea class="form-control texteditor" cols="30" rows="5" name="transfer_allocation_purpose"></textarea>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script type="text/javascript">
        function addCommas(yourNumber) {
            var n= yourNumber.toString().split(".");
            n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return n.join(".");
        }

        $(function () {
            $('.currency').maskMoney();

            $('.texteditor').summernote({
                toolbar: [],
                height: 100
            });
            
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

                        if (data.amount > 0) {
                            $('#' + panel_id + '_total_allocation').val(addCommas(data.amount));
                        } else {
                            $('#' + panel_id + '_total_allocation').val('0.00');
                        }

                        if (data.balance > 0) {
                            if (data.balance == data.amount) {
                                $('#' + panel_id + '_current_balance').val(addCommas(data.balance));
                            } else {
                                $('#' + panel_id + '_current_balance').val(addCommas(data.balance.toFixed(2)));
                            }
                        } else {
                            $('#' + panel_id + '_current_balance').val('0.00');
                        }
                    },
                    error: function (xhr, desc, err) {
                        console.log('error');
                    }
                });
            });

            $('#transfer_verify_allocation').on('blur', function () {
                var verify_transfer = $('#transfer_verify_allocation').val().replace(/,/g, '');
                var transfer = $('#transfer_total_allocation').val().replace(/,/g, '');
                var sub_from_b01_current_balance = $('#sub_from_b01_current_balance').val().replace(/,/g, '');
                var sub_to_b01_current_balance = $('#sub_to_b01_current_balance').val().replace(/,/g, '');

                if (transfer !== verify_transfer) {
                    alert('Jumlah Pindahan Peruntukan dan Jumlah Pengesahan Pindah Peruntukan tidak sama. Sila semak semula.');
                    $('#transfer_verify_allocation').val('');
                    $('#transfer_total_allocation').val('');
                }

                if (Math.round(verify_transfer) > Math.round(sub_from_b01_current_balance)) {
                    alert('Jumlah Pindahan Peruntukan mestilah lebih kecil atau sama dengan baki semasa.');
                    $('#transfer_verify_allocation').val('');
                    $('#transfer_total_allocation').val('');
                }

                if (Math.round(verify_transfer) <= Math.round(sub_from_b01_current_balance)) {
                    var update_from_balance = (Math.round(sub_from_b01_current_balance) - Math.round(verify_transfer)).toFixed(2);
                    var update_to_balance = (Math.round(sub_to_b01_current_balance) + Math.round(verify_transfer)).toFixed(2);
                    
                    $('#sub_from_b01_update_allocation').val(addCommas(update_from_balance));
                    $('#sub_to_b01_update_allocation').val(addCommas(update_to_balance));
                }
            });
        });
    </script>
@endpush