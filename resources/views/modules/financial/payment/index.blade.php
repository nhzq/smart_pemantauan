@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/nhzq.css') }}">
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
                                        <button class="btn btn-diamond" data-toggle="collapse" data-target="#search" type="">
                                            <i class="fa fa-fw fa-search"></i> Carian
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
                    <div class="panel-heading panel-dark">
                        Bayaran Kemajuan
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="font-p">
                                    <tr class="info">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nama Projek</th>
                                        <th class="text-center">Kos Sebenar</th>
                                        <th class="text-center">Status</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="font-std">
                                    @if (count($projects) > 0)
                                        @foreach ($projects as $data)
                                            @if (count($data->interims->where('active', 1)->whereIn('status', [1, 2])) > 0)
                                                <tr>
                                                    <td class="text-center align-center">{{ $loop->iteration }}</td>
                                                    <td class="align-center">{{ $data->name ?? '' }}</td>
                                                    <td class="text-right align-center">{{ currency($data->actual_project_cost) }}</td>

                                                    @if (count($data->interims->where('active', 1)->where('status', 1)) > 0)
                                                        <td class="text-center align-center">Semakan Bayaran Kemajuan</td>
                                                    @else
                                                        <td class="text-center align-center">Selesai Pembayaran</td>
                                                    @endif
                                                    
                                                    <td class="max10 text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('payments.list', $data->id) }}" class="btn btn-sm bg-purple">
                                                                <i class="fa fa-fw fa-folder-open-o"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
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