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
                    <div class="panel-body panel-nav">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-sm-2" style="padding-left: 0;">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <select class="form-control">
                                            <option>2018</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button class="btn btn-diamond" data-toggle="collapse" data-target="#search" type=""><i class="fa fa-fw fa-search"></i> Carian</button>

                                        <button class="btn btn-diamond" data-toggle="modal" data-target="#modal-default">
                                            <i class="fa fa-fw fa-plus"></i> Peruntukan Tambahan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">Peruntukan mengikut Kategori Bajet</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="font-p">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Kod</th>
                                        <th class="text-center">Butiran</th>
                                        <th class="text-center">Peruntukan &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center">Peruntukan Tambahan &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center">Anggaran Kos &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center">Kos Projek &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center">Jumlah Belanja &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center">Baki Belanja &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody class="font-std">
                                    @if (!empty($lists))
                                        @foreach ($lists as $data)
                                            <tr>
                                                <?php 
                                                    $provision = $data->provisions()
                                                        ->where('active', 1)
                                                        ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                                        ->first();

                                                    $total_estimate_cost = $provision->allocations()
                                                        ->where('active', 1)
                                                        ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                                        ->sum('amount');
                                                ?>

                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $data->code ?? '-' }}</td>
                                                <td>
                                                    <a href="{{ !empty($provision) ? route('allocations.index', $provision->id) : '' }}">{{ $data->description ?? '-' }}</a>
                                                </td>
                                                <td class="text-right">{{ !empty($provision->amount) ? currency($provision->amount) : '0.00' }}</td>
                                                <td class="text-right">{{ currency($provision->extra_budget) }}</td>
                                                <td class="text-right">{{ currency($total_estimate_cost) }}</td>
                                                <td class="text-right"></td>
                                                <td class="text-right"></td>
                                                <td></td>
                                                <td>
                                                    <a href="{{ route('provisions.edit', $data->id) }}">Kemaskini</a>
                                                </td>
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

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <div class="modal-title font-h5">Peruntukan Tambahan</div>
                    </div>
                    {{ Form::open(['url' => route('provisions.additional'), 'method' => 'POST']) }}
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Kategori</label>
                                    <div class="col-sm-9">
                                        <select id="category" class="form-control" name="category">
                                            <option value="0">-- Sila Pilih --</option>
                                            @foreach ($lists as $data)
                                                <option value="{{ $data->id }}">{{ setBudgetTitle($data->code, $data->description, 'no-bold') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Jenis Peruntukan</label>
                                    <div class="col-sm-9">
                                        <select id="provision_type" class="form-control" name="allocation_type">
                                            <?php 
                                                $types = [
                                                    'Dasar Baru',
                                                    'One Off'
                                                ];
                                            ?>
                                            <option value="0">-- Sila Pilih --</option>
                                            @foreach ($types as $data)
                                                <option value="{{ $data }}">{{ $data }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Jumlah</label>
                                    <div class="col-sm-9">
                                        <input id="additional_provision" class="form-control money-convert" type="text" name="additional_provision">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Kemaskini Peruntukan Tambahan</button>
                        </div>
                    {{ Form::close() }}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
    <!-- /.content -->
@endsection

@push ('script')
    <script src="{{ asset('adminlte/plugin/maskMoney/jquery.maskMoney.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('.money-convert').maskMoney();

            $('.close').on('click', function () {
                $('#category').val(0);
                $('#provision_type').val(0);
                $('#additional_provision').val('');
            });
        });
    </script>
@endpush