@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/panel-tab.css') }}">
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
                                        <a href="{{ route('bspk.transfers.create') }}" class="btn btn-diamond">
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
                        Pindah Peruntukan
                        <span class="pull-right">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li><a href="{{ route('transfers.index') }}">Pindah Peruntukan untuk BAPK</a></li>
                                <li class="active"><a href="{{ route('bspk.transfers.index') }}">Pindah Peruntukan untuk BSPK</a></li>
                            </ul>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead class="font-p">
                                            <tr class="info">
                                                <th class="text-center align-center">#</th>
                                                <th class="text-center align-center">Tarikh Kelulusan</th>
                                                <th class="text-center align-center">Dari Projek</th>
                                                <th class="text-center align-center">Ke Projek</th>
                                                <th class="text-center align-center">No Waran</th>
                                                <th class="text-center align-center">Tarikh Waran</th>
                                                <th class="text-center align-center">Tujuan</th>
                                                <th class="text-center align-center">Jumlah Pindah Peruntukan (RM)</th>
                                                {{-- <th>Tindakan</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody class="font-std">
                                            @if (!empty($bspk))
                                                @foreach ($bspk as $data)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <?php 
                                                            $approval_date = '';
                                                            $warrant_date = '';

                                                            if (!empty($data->approval_date)) {
                                                                $approval_date = $data->approval_date->format('d/m/Y');
                                                            }

                                                            if (!empty($data->warrant_date)) {
                                                                $warrant_date = $data->warrant_date->format('d/m/Y');
                                                            }
                                                        ?>
                                                        <td class="text-center">{{ $approval_date }}</td>
                                                        <td>{{ !empty($data->fromProject) ? $data->fromProject->name : '' }}</td>
                                                        <td>{{ !empty($data->toProject) ? $data->toProject->name : '' }}</td>
                                                        <td>{{ $data->warrant_no ?? '' }}</td>
                                                        <td class="text-center">{{ $warrant_date }}</td>
                                                        <td>{!! $data->purpose ?? '' !!}</td>
                                                        <td class="text-right">{{ currency($data->transfer_amount) }}</td>
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
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@push ('script')
@endpush