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
                        <h3 class="box-title">Kemaskini Pengguna</h3>
                    </div>

                    <div class="box-body">
                        {{ Form::open(['url' => route('allocations.update', $allocation->id), 'method' => 'PUT']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('budget_type') ? 'has-error' : '' }}">
                                            <label>Jenis Bajet</label>
                                            <select id="budget_type" class="form-control" name="budget_type">
                                                <option>-- Sila Pilih --</option>
                                                @foreach ($budgets as $data)
                                                    <?php 
                                                        $selected = '';

                                                        if ($allocation->lookup_budget_type_id == $data->id) {
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                    <option value="{{ $data->id }}" {{ $selected }}>{{ $data->code . ' : ' . $data->description}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Butiran</label>
                                            <select id="budget_sub" class="form-control" name="budget_sub">
                                                <option>-- Sila Pilih --</option>
                                                @foreach ($subBudgets as $data)
                                                    <?php 
                                                        $selected = '';

                                                        if ($allocation->lookup_sub_budget_type_id == $data->id) {
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                    <option value="{{ $data->id }}" {{ $selected }}>{{ $data->code . ' : ' . $data->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('budget_allocation') ? 'has-error' : '' }}">
                                            <label>Peruntukan (RM)</label>
                                            <input class="form-control money-convert" type="text" name="budget_allocation" placeholder="Peruntukan" value="{{ currency($allocation->amount) ?? '' }}">
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
            
            $('#budget_type').on('change', function () {
                var selected_value = $(this).val();
                var type = '';

                $.ajax({
                    type: 'GET',
                    datatype: 'json',
                    url: '{{ route('allocations.create.type') }}',
                    data: {
                        'id': selected_value
                    },
                    success: function (data) {
                        type += '<option>-- Sila Pilih --</option>';

                        for (var i = 0; i < data.length; i++) {
                            type += '<option value="' + data[i].id + '">' + data[i].code + ' : ' + data[i].description + '</option>';
                        }

                        $('#budget_sub').html(" ");
                        $('#budget_sub').append(type);
                    },
                    error: function (xhr, desc, err) {
                        console.log('error');
                    }
                });
            });
        });
    </script>
@endpush