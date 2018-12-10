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
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Maklumat Projek</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <tr class="tbl-row-init tbl-default">
                                        <th colspan="2" class="text-center">Maklumat Asas</th>
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
                                            $approval_date = '-';

                                            if (!empty($project->approval_date)) {
                                                $approval_date = $project->approval_date->format('m/d/Y');
                                            }
                                        ?>
                                        <td>{{ $approval_date }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Kertas Cadangan</th>
                                        <td>
                                            @if (count($project->documents) > 0)
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
                                    <tr>
                                        <th class="col-md-3 min100">Kajian Pasaran</th>
                                        <td>
                                            @if (!empty($project->market_research))
                                                @if (count($project->documents) > 0)
                                                    @foreach ($project->documents as $data)
                                                        @if ($data->category == 'kajian-pasaran')
                                                            <a href="{{ route('projects.file.download', [$project->id, $data->file_name]) }}">
                                                                <small class="label bg-maroon"><i class="fa fa-download"></i></small>
                                                                &nbsp; {{ $data->original_name }}
                                                            </a>
                                                            </br>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    Tiada
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="tbl-row-init tbl-row-end tbl-default">
                                        <th colspan="2" class="text-center">Maklumat Projek</th>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Objektif Projek</th>
                                        <td>{!! $project->objective ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh Kelulusan Minit Bebas</th>
                                        <?php 
                                            $approval_date = '';

                                            if (!is_null($project->minute_approval_date)) {
                                                $approval_date = $project->minute_approval_date->format('m/d/Y');
                                            }
                                        ?>
                                        <td>{{ $approval_date }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Minit Bebas</th>
                                        <td>
                                            @if (count($project->documents) > 0)
                                                @foreach ($project->documents as $data)
                                                    @if ($data->category == 'minit-bebas')
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
                                        <th class="col-md-3 min100">Tarikh Kelulusan PWN</th>
                                        <?php 
                                            $pwn_date = '';

                                            if (!is_null($project->approval_pwn_date)) {
                                                $pwn_date = $project->approval_pwn_date->format('m/d/Y');
                                            }
                                        ?>
                                        <td>{{ $pwn_date }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Surat Kelulusan PWN</th>
                                        <td>
                                            @if (count($project->documents) > 0)
                                                @foreach ($project->documents as $data)
                                                    @if ($data->category == 'surat-pwn')
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
                                        <th class="col-md-3 min100">Jenis Perolehan</th>
                                        <td>{{ $project->collection->name ?? '' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
