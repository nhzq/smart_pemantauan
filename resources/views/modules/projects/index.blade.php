@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
@endpush

@section ('content')
    <!-- Content Header (Page header) -->
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
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button class="btn btn-diamond" data-toggle="collapse" data-target="#search" type="button"><i class="fa fa-fw fa-search"></i> Carian</button>

                                        @hasrole('ku')
                                            <a href="{{ route('projects.create') }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Projek
                                            </a>
                                        @endhasrole
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div id="search" class="collapse">
                                <hr>

                                {{ Form::open(['url' => route('search.project'), 'method' => 'GET']) }}
                                    <div class="col-md-12">
                                        {{-- <a href="{{ route('export.file',['type'=>'xlsx']) }}">Download Excel xlsx</a> --}}
                                        <div class="col-sm-4">
                                            <label>Tahun</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <select class="form-control" name="search_year">
                                                    <option value="0">-- Sila Pilih --</option>

                                                    <?php for ($x = \Carbon\Carbon::now()->year; $x >= 2018; $x--) { ?>
                                                        <option value="{{ $x }}">{{ $x }}</option>
                                                    <?php }; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nama Projek</label>
                                                <input class="form-control" type="text" name="search_name" placeholder="Nama Projek">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <label>Objek Sebagai</label>
                                            <select class="form-control">
                                                <option>-- Sila Pilih --</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mrg20B pull-right">
                                        <button class="btn btn-block btn-primary" type="submit">
                                            Carian
                                        </button>
                                    </div>
                                {{ Form::close() }}
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
                        Senarai Projek
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered font-std">
                                <thead>
                                    <tr class="info">
                                        <th class="text-center align-center">#</th>
                                        <th class="text-center align-center">Nama Projek</th>
                                        <th class="text-center align-center">Pindah Peruntukan <br> - Dari (RM)</th>
                                        <th class="text-center align-center">Pindah Peruntukan <br> - Ke (RM)</th>
                                        <th class="text-center align-center">Anggaran <br> Kos (RM)</th>
                                        <th class="text-center align-center">Kos Projek <br> (RM)</th>
                                        <th class="text-center align-center">Jumlah <br> Belanja (RM)</th>
                                        <th class="text-center align-center">Baki <br> Belanja (RM)</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (\Auth::user()->hasAnyRole('ku|ks'))
                                        @if (!empty($subs))
                                            @foreach ($subs as $sub)
                                                <?php
                                                    if (\Auth::user()->hasRole('ks')) {
                                                        if (Route::current()->getName() == 'search.project') {
                                                            $lists = count($sub->projects()
                                                                ->where('active', 1)
                                                                ->where('section_id', \Auth::user()->lookup_section_id)
                                                                ->where('created_at', 'LIKE', '%' . $request_year . '%')
                                                                ->get());
                                                        } else {
                                                            $lists = count($sub->projects()
                                                                ->where('active', 1)
                                                                ->where('section_id', \Auth::user()->lookup_section_id)
                                                                ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                                                ->get());
                                                        }
                                                    } 

                                                    if (\Auth::user()->hasRole('ku')){
                                                        if (Route::current()->getName() == 'search.project') {
                                                            $lists = count($sub->projects()
                                                                ->where('active', 1)
                                                                ->where('unit_id', \Auth::user()->lookup_unit_id)
                                                                ->where('created_at', 'LIKE', '%' . $request_year . '%')
                                                                ->get());
                                                        } else {
                                                            $lists = count($sub->projects()
                                                                ->where('active', 1)
                                                                ->where('unit_id', \Auth::user()->lookup_unit_id)
                                                                ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                                                ->get());
                                                        }
                                                    }
                                                ?>

                                                @if ($lists > 0)
                                                    <tr class="danger">
                                                        <th colspan="10">{!! setBudgetTitle($sub->code, $sub->description) !!}</th>
                                                    </tr>

                                                    @foreach ($projects as $data)
                                                        @if ($data->lookup_sub_budget_type_id == $sub->id)
                                                            <tr>
                                                                <td class="text-center align-center">
                                                                    {{ $projects->perPage() * ($projects->currentPage() - 1) + $loop->iteration }}
                                                                </td>
                                                                <td class="align-center">
                                                                    {{ $data->name }}
                                                                    
                                                                    <div class="pull-right">
                                                                        @include ('components._status')
                                                                    </div>
                                                                </td>
                                                                <?php 
                                                                    $from_transfer = 0;
                                                                    $to_transfer = 0;

                                                                    if (!empty($data->bspkTransfers)) {
                                                                        $from_transfer = $data->bspkTransfers()
                                                                            ->where('from_project_id', $data->id)
                                                                            ->where('active', 1)
                                                                            ->where('bspk_transfers.created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                                                            ->sum('transfer_amount');

                                                                        $to_transfer = $data->bspkTransfers()
                                                                            ->where('to_project_id', $data->id)
                                                                            ->where('active', 1)
                                                                            ->where('bspk_transfers.created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                                                            ->sum('transfer_amount');
                                                                    }
                                                                ?>
                                                                <td class="text-right align-center">{{ '-' . currency($from_transfer) }}</td>
                                                                <td class="text-right align-center">{{ currency($to_transfer) }}</td>
                                                                <td class="text-right align-center">{{ currency($data->estimate_cost) }}</td>
                                                                <td class="text-right align-center">{{ currency($data->actual_project_cost) }}</td>
                                                                <td class="text-right align-center">{{ '0.00' }}</td>
                                                                <td class="text-right align-center">{{ '0.00' }}</td>
                                                                <td class="text-center align-center min90">
                                                                    <div class="btn-group">
                                                                        @if (\Auth::user()->hasRole('ku'))
                                                                            <a href="{{ route('projects.show', $data->id) }}" class="btn btn-sm bg-purple">
                                                                                <i class="fa fa-fw fa-folder-open-o"></i>
                                                                            </a>
                                                                            <button class="btn btn-sm btn-danger" type="submit">
                                                                                <i class="fa fa-fw fa-trash-o"></i>
                                                                            </button>
                                                                        @endif

                                                                        @if (\Auth::user()->hasRole('ks'))
                                                                            @if (\App\Helpers\Status::project_verification($data->status))
                                                                                <a href="{{ route('info.index', $data->id) }}" class="btn btn-sm bg-purple">
                                                                                    <i class="fa fa-fw fa-folder-open-o"></i>
                                                                                </a>
                                                                            @else
                                                                                <a href="{{ route('projects.show', $data->id) }}" class="btn btn-sm bg-purple">
                                                                                    <i class="fa fa-fw fa-folder-open-o"></i>
                                                                                </a>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                    
                                    @if (\Auth::user()->hasRole('sub'))
                                        @if (!empty($projectsForSUB))
                                            @foreach ($projectsForSUB as $data)
                                                <tr>
                                                    <td class="text-center align-center">
                                                        {{ $projectsForSUB->perPage() * ($projectsForSUB->currentPage() - 1) + $loop->iteration }}
                                                    </td>
                                                    <td class="align-center">
                                                        {{ $data->name }}

                                                        <div class="pull-right">
                                                            @include ('components._status')
                                                        </div>
                                                    </td>
                                                    <td class="text-right align-center">{{ '0.00' }}</td>
                                                    <td class="text-right align-center">{{ '0.00' }}</td>
                                                    <td class="text-right align-center">{{ currency($data->estimate_cost) }}</td>
                                                    <td class="text-right align-center">{{ '0.00' }}</td>
                                                    <td class="text-right align-center">{{ '0.00' }}</td>
                                                    <td class="text-right align-center">{{ '0.00' }}</td>
                                                    <td class="text-center align-center max60">
                                                        <div class="btn-group">
                                                            <a href="{{ route('projects.show', $data->id) }}" class="btn btn-sm bg-purple">
                                                                <i class="fa fa-fw fa-folder-open-o"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif

                                    @if (\Auth::user()->hasAnyRole('ssdu|unisel'))
                                        @if (!empty($projectsForOfficer))
                                            @if (!empty($subs))
                                                @foreach ($subs as $sub)
                                                    <?php 
                                                        $countProjects = $sub->projects()
                                                            ->where('active', 1)
                                                            ->where('created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                                            ->where('appointed_to', \Auth::user()->id)
                                                            ->get();

                                                        $lists = count($countProjects);
                                                    ?>

                                                    @if ($lists > 0)
                                                        <tr class="danger">
                                                            <th colspan="9">{!! setBudgetTitle($sub->code, $sub->description) !!}</th>
                                                        </tr>

                                                        @foreach ($projectsForOfficer as $data)
                                                            @if ($data->lookup_sub_budget_type_id == $sub->id)
                                                                <tr>
                                                                    <td class="text-center align-center">
                                                                        {{ $projects->perPage() * ($projects->currentPage() - 1) + $loop->iteration }}
                                                                    </td>
                                                                    <td class="align-center">{{ $data->name }}</td>

                                                                    <?php 
                                                                        $from_transfer = 0;
                                                                        $to_transfer = 0;

                                                                        if (!empty($data->bspkTransfers)) {
                                                                            $from_transfer = $data->bspkTransfers()
                                                                                ->where('from_project_id', $data->id)
                                                                                ->where('active', 1)
                                                                                ->where('bspk_transfers.created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                                                                ->sum('transfer_amount');

                                                                            $to_transfer = $data->bspkTransfers()
                                                                                ->where('to_project_id', $data->id)
                                                                                ->where('active', 1)
                                                                                ->where('bspk_transfers.created_at', 'LIKE', '%' . \Carbon\Carbon::now()->year . '%')
                                                                                ->sum('transfer_amount');
                                                                        }
                                                                    ?>
                                                                    <td class="text-right align-center">{{ '-' . currency($from_transfer) }}</td>
                                                                    <td class="text-right align-center">{{ currency($to_transfer) }}</td>
                                                                    <td class="text-right align-center">{{ currency($data->estimate_cost) }}</td>
                                                                    <td class="text-right align-center">{{ currency($data->actual_project_cost) }}</td>
                                                                    <td class="text-right align-center">{{ '0.00' }}</td>
                                                                    <td class="text-right align-center">{{ '0.00' }}</td>
                                                                    <td class="text-center align-center max60">
                                                                        <div class="btn-group">
                                                                            <a href="{{ route('projects.show', $data->id) }}" class="btn btn-sm bg-purple">
                                                                                <i class="fa fa-fw fa-folder-open-o"></i>
                                                                            </a>
                                                                            <button class="btn btn-sm btn-danger" type="submit">
                                                                                <i class="fa fa-fw fa-trash-o"></i>
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="pull-right">
                            {{ $projects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@push ('script')
    <script src="{{ asset('adminlte/dist/js/rowspanizer.js') }}"></script>
    <script>
        // $(function () {
        //     $("#custom-row").rowspanizer({
        //         vertical_align: 'middle',
        //         columns: [0, 1]
        //     });
        // });
    </script>
@endpush

