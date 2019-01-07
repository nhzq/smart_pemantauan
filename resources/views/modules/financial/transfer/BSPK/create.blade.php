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
                        {{ Form::open(['url' => route('bspk.transfers.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
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
                                            <div class="panel-heading bck-diamond font-h5">Senarai Butiran dari B01</div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-tip: 5px;">Butiran</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <select id="from_sub" class="form-control get_sub_list" name="from_sub">
                                                            <option value="0">-- Sila Pilih --</option>
                                                            @foreach ($subs as $data)
                                                                <option value="{{ $data->id }}">{{ setBudgetTitle($data->code, $data->description, 'no-bold') }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-tip: 5px;">Projek</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <select id="project_from_sub" class="form-control get_project_list" name="project_from_sub">
                                                            <option value="0">-- Sila Pilih --</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-top: 5px;">Jumlah Peruntukan (RM)</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input id="project_from_sub_total_allocation" class="form-control" type="text" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-top: 5px;">Baki Semasa (RM)</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input id="project_from_sub_current_balance" class="form-control" type="text" name="" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-top: 5px;">Peruntukan Kemaskini (RM)</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input id="project_from_sub_update_allocation" class="form-control" type="text" name="" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading bck-diamond font-h5">Senarai Butiran dari B01</div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-tip: 5px;">Butiran</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <select id="to_sub" class="form-control get_sub_list" name="to_sub">
                                                            <option value="0">-- Sila Pilih --</option>
                                                            @foreach ($subs as $data)
                                                                <option value="{{ $data->id }}">{{ setBudgetTitle($data->code, $data->description, 'no-bold') }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-tip: 5px;">Projek</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <select id="project_to_sub" class="form-control get_project_list" name="project_to_sub">
                                                            <option value="0">-- Sila Pilih --</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-top: 5px;">Jumlah Peruntukan (RM)</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input id="project_to_sub_total_allocation" class="form-control" type="text" name="" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-top: 5px;">Baki Semasa (RM)</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input id="project_to_sub_current_balance" class="form-control" type="text" name="" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-5">
                                                        <label class="control-label" style="padding-top: 5px;">Peruntukan Kemaskini (RM)</label>
                                                    </div>
                                                    <div class="col-md-7 mrg10B">
                                                        <input id="project_to_sub_update_allocation" class="form-control" type="text" name="" readonly>
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
                                        <div class="form-group {{ $errors->has('transfer_total') ? 'has-error' : '' }}">
                                            <label>Jumlah Pindah Peruntukan (RM)</label>
                                            <input id="transfer_total" class="form-control currency" type="text" name="transfer_total">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('transfer_verify') ? 'has-error' : '' }}">
                                            <label>Pengesahan Pindah Peruntukan (RM)</label>
                                            <input id="transfer_verify" class="form-control currency" type="text" name="transfer_verify">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tujuan Pindah Peruntukan</label>
                                            <textarea class="form-control texteditor" cols="30" rows="5" name="transfer_purpose"></textarea>
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
    <script>
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
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            $('.get_sub_list').on('change', function () {
                var selected_value = $(this).val();
                var panel_id = $(this).attr('id');
                var type = '';

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('bspk.transfers.create.type') }}',
                    data: {
                        'id': selected_value
                    },
                    success: function (data) {
                        type += '<option value="0">-- Sila Pilih --</option>';

                        for (var i = 0; i < data.length; i++) {
                            type += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                        }

                        $('#project_' + panel_id).html(" ");
                        $('#project_' + panel_id).append(type);
                    },
                    error: function (xhr, desc, err) {
                        console.log('error');
                    }
                });
            });

            $('.get_project_list').on('change', function () {
                var selected_value = $(this).val();
                var panel_id = $(this).attr('id');

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('bspk.transfers.create.project') }}',
                    data: {
                        'id': selected_value
                    },
                    success: function (data) {
                        $('#' + panel_id + '_total_allocation').val(' ');
                        $('#' + panel_id + '_current_balance').val(' ');

                        if (data.amount > 0) {
                            var dataAmount = parseFloat(data.amount);

                            $('#' + panel_id + '_total_allocation').val(addCommas(dataAmount.toFixed(2)));
                        } else {
                            $('#' + panel_id + '_total_allocation').val('0.00');
                        }

                        if (data.balance > 0) {
                            var dataBalance = parseFloat(data.balance);
                            
                            $('#' + panel_id + '_current_balance').val(addCommas(dataBalance.toFixed(2)));
                        } else {
                            $('#' + panel_id + '_current_balance').val('0.00');
                        }
                    },
                    error: function (xhr, desc, err) {
                        console.log('error');
                    }
                });
            });

            $('#transfer_verify').on('blur', function () {
                var verify_transfer = $('#transfer_verify').val().replace(/,/g, '');
                var transfer = $('#transfer_total').val().replace(/,/g, '');
                var project_from_sub_current_balance = $('#project_from_sub_current_balance').val().replace(/,/g, '');
                var project_to_sub_current_balance = $('#project_to_sub_current_balance').val().replace(/,/g, '');

                if (transfer !== verify_transfer) {
                    alert('Jumlah Pindahan Peruntukan dan Jumlah Pengesahan Pindah Peruntukan tidak sama. Sila semak semula.');
                    $('#transfer_verify').val('');
                    $('#transfer_total').val('');
                }

                if (Math.round(verify_transfer) > Math.round(project_from_sub_current_balance)) {
                    alert('Jumlah Pindahan Peruntukan mestilah lebih kecil atau sama dengan baki semasa.');
                    $('#transfer_verify').val('');
                    $('#transfer_total').val('');
                }

                if (Math.round(verify_transfer) <= Math.round(project_to_sub_current_balance)) {
                    var update_from_balance = (Math.round(project_from_sub_current_balance) - Math.round(verify_transfer)).toFixed(2);
                    var update_to_balance = (Math.round(project_to_sub_current_balance) + Math.round(verify_transfer)).toFixed(2);
                    
                    $('#project_from_sub_update_allocation').val(addCommas(update_from_balance));
                    $('#project_to_sub_update_allocation').val(addCommas(update_to_balance));
                }
            });
        });
    </script>
@endpush