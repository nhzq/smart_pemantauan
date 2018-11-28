@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/table.css') }}">
@endpush

@section ('content')
    <!-- Content Header (Page header) -->
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        @include ('components._phases')

        <div class="row">
            @include ('components._menu')

            <div class="col-md-9">
                @if (\Auth::user()->hasRole('ku'))
                    @if (\App\Helpers\Status::isApprovedBySUB($project->status))
                        <div class="box box-solid">
                            <div class="box-body">
                                <div class="col-md-8">
                                    <h5>Sila Kemaskini Maklumat Projek di sini untuk Fasa Perancangan.</h5>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('projects.phase', $project->id) }}" class="btn bg-purple pull-right">Kemaskini Projek</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Maklumat Asas</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <tr class="tbl-row-init tbl-default">
                                        <th class="col-md-3 min100">&nbsp;</th>
                                        <th>Maklumat</th>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Nama Projek</th>
                                        <td>{{ $project->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">No Rujukan Fail</th>
                                        <td>{{ $project->file_reference_no ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Skop/Konsep/Tujuan</th>
                                        <td>{!! $project->concept ?? 'N/A' !!}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Anggaran Kos (RM)</th>
                                        <td>{{ currency($project->estimate_cost) ?? '0.00' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh Kelulusan JPICT</th>
                                        <?php 
                                            $approval_date = '';

                                            if (!empty($project->approval_date)) {
                                                $approval_date = $project->approval_date->format('m/d/Y');
                                            }
                                        ?>
                                        <td>{{ $approval_date }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Kertas Cadangan</th>
                                        <td>
                                            @if (!empty($project->documents))
                                                @foreach ($project->documents as $data)
                                                        @if ($data->category == 'kertas-cadangan')
                                                            <a href="{{ route('projects.file.download', [$project->id, $data->file_name]) }}">
                                                                <small class="label bg-maroon"><i class="fa fa-download"></i></small>
                                                                &nbsp; {{ $data->original_name }}
                                                            </a>
                                                            </br>
                                                        @endif
                                                @endforeach
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Jenis Bajet</th>
                                        <?php 
                                            $budgetType = '';
                                            
                                            if (!empty($project->budget->code) && !empty($project->budget->description)) {
                                                $budgetType = $project->budget->code . ' : ' . $project->budget->description;
                                            }
                                        ?>
                                        <td><strong>{{ $budgetType }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Jenis Sub Bajet</th>
                                        <?php 
                                            $subType = '';

                                            if (!empty($project->sub->code) && !empty($project->sub->description)) {
                                                $subType = $project->sub->code . ' : ' . $project->sub->description;
                                            }
                                        ?>
                                        <td><strong>{{ $subType }}</strong></td>
                                    </tr>
                                    @if ($project->market_research == 1)
                                        <tr>
                                            <th class="col-md-3 min100">Kajian Pasaran</th>
                                            <td>
                                                @if (!empty($project->documents))
                                                    @foreach ($project->documents as $data)
                                                        @if ($data->category == 'kajian-pasaran')
                                                            <a href="{{ route('projects.file.download', [$project->id, $data->file_name]) }}">
                                                                <small class="label bg-maroon"><i class="fa fa-download"></i></small>
                                                                &nbsp; {{ $data->original_name }}
                                                            </a>
                                                            </br>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        @if ($project->status !== 10)
                                            <th class="col-md-3 min100">Status</th>
                                            <td> @include('components._status') </td>
                                        @endif
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @if (\Auth::user()->hasRole('ks'))
                    @if (\App\Helpers\Status::isAppliedByKU($project->status))
                        {{ Form::open(['method' => 'POST']) }}
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Komen</label>
                                                    <textarea class="form-control" rows="5" name="review_content"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mrg10B mrg10T pull-right">
                                        <div class="btn-group">
                                            <button class="btn btn-primary" type="submit" formaction="{{ route('reviews.approve.ks', $project->id) }}">Terima</button>
                                            <button class="btn btn-danger" type="submit" formaction="{{ route('reviews.reject.ks', $project->id) }}">Tolak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{ Form::close() }}
                    @endif
                @endif

                @if (\Auth::user()->hasRole('sub'))
                    @if (\App\Helpers\Status::isApprovedByKS($project->status))
                        {{ Form::open(['method' => 'POST']) }}
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Komen</label>
                                                    <textarea class="form-control" rows="5" name="review_content"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mrg10B mrg10T pull-right">
                                        <div class="btn-group">
                                            <button class="btn btn-primary" type="submit" formaction="{{ route('reviews.approve.sub', $project->id) }}">Terima</button>
                                            <button class="btn btn-danger" type="submit" formaction="{{ route('reviews.reject.sub', $project->id) }}">Tolak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{ Form::close() }}
                    @endif
                @endif
            </div>
        </div>
    </section>
@endsection
