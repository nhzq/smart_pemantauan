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
                                        <button class="btn btn-diamond" data-toggle="collapse" data-target="#search" type="button"><i class="fa fa-fw fa-search"></i> Carian</button>

                                        @hasrole('ku')
                                            <a href="{{ route('projects.create') }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Tambah Projek
                                            </a>
                                        @endhasrole
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div id="search" class="collapse">
                                <hr>

                                {{ Form::open(['url' => route('projects.index'), 'method' => 'GET']) }}
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nama Projek</label>
                                                    <input class="form-control" type="text" name="Search_name" placeholder="Nama Projek">
                                                </div>
                                            </div>
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
                            <table id="custom-row" class="table table-bordered">
                                <thead class="font-p">
                                    <tr class="info">
                                        <th>Jenis Bajet</th>
                                        <th>Jumlah &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th>#</th>
                                        <th>Nama Projek</th>
                                        <th class="col-sm-2">Anggaran Kos &nbsp;<span class="label bck-diamond">RM</span></th>
                                        <th class="col-sm-1">Status</th>
                                        <th class="col-sm-1">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (\Auth::user()->hasAnyRole('ku|ks'))
                                        @if (!empty($projects))
                                            @foreach ($projects as $key => $data)
                                                <?php
                                                    $total_sub_budget = \App\Models\Project::where('lookup_sub_budget_type_id', $data->lookup_sub_budget_type_id)
                                                                            ->sum('estimate_cost');
                                                ?>

                                                <tr>
                                                    <td>{!! setBudgetTitle($data->sub->code, $data->sub->description) !!}</td>
                                                    <td>{{ currency($total_sub_budget) }}</td>
                                                    <td>{{ $projects->perPage() * ($projects->currentPage() - 1) + $loop->iteration }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ currency($data->estimate_cost) }}</td>
                                                    <td> @include ('components._status') </td>
                                                    <td>
                                                        <div class="min130">
                                                            <div class="btn-group">
                                                                @if (\Auth::user()->hasRole('ku'))
                                                                    <a href="{{ route('projects.show', $data->id) }}" class="btn bg-purple">
                                                                        <i class="fa fa-fw fa-folder-open-o"></i>
                                                                    </a>
                                                                    <a href="{{ route('projects.edit', $data->id) }}" class="btn bg-purple">
                                                                        <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                    </a>
                                                                    <button class="btn btn-danger" type="submit">
                                                                        <i class="fa fa-fw fa-trash-o"></i>
                                                                    </button>
                                                                @endif

                                                                @if (\Auth::user()->hasRole('ks'))
                                                                    @if (\App\Helpers\Status::planningByKU($data->status))
                                                                        <a href="{{ route('info.index', $data->id) }}" class="btn bg-purple">
                                                                            <i class="fa fa-fw fa-folder-open-o"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="{{ route('projects.show', $data->id) }}" class="btn bg-purple">
                                                                            <i class="fa fa-fw fa-folder-open-o"></i>
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                    
                                    @if (\Auth::user()->hasRole('sub'))
                                        @if (!empty($projectsForSUB))
                                            @foreach ($projectsForSUB as $data)
                                                <?php 
                                                    $total_sub_budget = \App\Models\Project::where('lookup_sub_budget_type_id', $data->lookup_sub_budget_type_id)
                                                                            ->whereNotIn('status', [1, 3])
                                                                            ->sum('estimate_cost');
                                                ?>

                                                <tr>
                                                    <td>{!! setBudgetTitle($data->budget->code, $data->sub->description) !!}</td>
                                                    <td>{{ currency($total_sub_budget) }}</td>
                                                    <td>{{ $projectsForSUB->perPage() * ($projectsForSUB->currentPage() - 1) + $loop->iteration }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ currency($data->estimate_cost) }}</td>
                                                    <td> @include ('components._status') </td>
                                                    <td>
                                                        <div class="min130">
                                                            <div class="btn-group">
                                                                <a href="{{ route('projects.show', $data->id) }}" class="btn bg-purple">
                                                                    <i class="fa fa-fw fa-folder-open-o"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                </tbody>

                                <!--
                                <thead class="font-p">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Butiran</th>
                                        <th class="text-center">Peruntukan (RM)</th>
                                        <th class="text-center">Kos Projek (RM)</th>
                                        <th class="text-center">Belanja (RM)</th>
                                        <th class="text-center">Peratusan Belanja</th>
                                        <th class="text-center">Baki Semasa (RM)</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>

                                <tbody class="font-p">
                                    
                                </tbody>
                                -->
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
        $(function () {
            $("#custom-row").rowspanizer({
                vertical_align: 'middle',
                columns: [0, 1]
            });
        });
    </script>
@endpush
