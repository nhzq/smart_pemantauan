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
                                        <a href="{{ route('transfers.create') }}" class="btn btn-diamond">
                                            <i class="fa fa-fw fa-plus"></i> Pindah Peruntukan
                                        </a>
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
                    <div class="panel-heading panel-dark">
                        Pindah Peruntukan BAPK
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="font-p">
                                    <tr class="info">
                                        <th class="text-center align-center">#</th>
                                        <th class="text-center align-center">Tarikh Kelulusan</th>
                                        <th class="text-center align-center">Dari B01</th>
                                        <th class="text-center align-center">Ke B01</th>
                                        <th class="text-center align-center">No Waran</th>
                                        <th class="text-center align-center">Tarikh Waran</th>
                                        <th class="text-center align-center">Tujuan</th>
                                        <th class="text-center align-center">Jumlah Pindah Peruntukan &nbsp;<span class="label bck-diamond">RM</span></th>
                                        {{-- <th>Tindakan</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="font-std">
                                    @if (!empty($transfers))
                                        @foreach ($transfers as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <?php 
                                                    $date_formatted = '';

                                                    if (!empty($data->approval_date)) {
                                                        $date_formatted = $data->approval_date->format('m/d/Y');
                                                    }
                                                ?>
                                                <td>{{ $date_formatted }}</td>
                                                <td>{!! setBudgetTitle($data->subsFrom->code, $data->subsFrom->description) ?? '' !!}</td>
                                                <td>{!! setBudgetTitle($data->subsTo->code, $data->subsTo->description) ?? '' !!}</td>
                                                <td>{{ $data->warrant_no ?? '' }}</td>
                                                <?php 
                                                    $date_formatted_2 = '';

                                                    if (!empty($data->warrant_date)) {
                                                        $date_formatted_2 = $data->warrant_date->format('m/d/Y');
                                                    }
                                                ?>
                                                <td>{{ $date_formatted_2 }}</td>
                                                <td>{!! $data->purpose ?? '' !!}</td>
                                                <td class="text-right">{{ currency($data->transfer_amount) ?? '' }}</td>
                                                {{-- <td>
                                                    <div class="btn-group">
                                                        <a href="" class="btn bg-purple">
                                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                                        </a>
                                                    </div>
                                                </td> --}}
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
    </section>
    <!-- /.content -->
@endsection

@push ('script')
@endpush