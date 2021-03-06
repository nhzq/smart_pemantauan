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

        @include ('components._phases')

        <div class="row">
            @include ('components._menu')

            <div class="col-md-9">
                @if (!empty($project->contractorAppointment))
                    @if ($project->contractorAppointment->contract_end_date > \Carbon\Carbon::now()->subMonth(4))
                        <div class="panel panel-borderless">
                            <div class="panel-body panel-nav">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-left">
                                            <div class="btn-group">
                                                <a href="{{ route('notify.contract.end', $project->id) }}" class="btn btn-danger">
                                                    <i class="fa fa-fw fa-plus"></i> Notifikasi Kontrak
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Maklumat Projek
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered font-std">
                                    <tr class="info">
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
                                        <th class="col-md-3 min100">Tujuan</th>
                                        <td>{!! $project->initial_purpose ?? 'N/A' !!}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Skop</th>
                                        <td>{!! $project->initial_scope ?? 'N/A' !!}</td>
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
                                                            <a href="{{ url('storage/projects/' . $project->id . '/' . $data->file_name) }}">
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
                                                            <a href="{{ url('storage/projects/' . $project->id . '/' . $data->file_name) }}">
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
                                    <tr class="info">
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
                                                        <a href="{{ url('storage/projects/' . $project->id . '/' . $data->file_name) }}">
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
                                                        <a href="{{ url('storage/projects/' . $project->id . '/' . $data->file_name) }}">
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
