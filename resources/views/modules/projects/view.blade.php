@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
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
                @hasanyrole ('ku')
                    <div class="panel panel-borderless">
                        <div class="panel-body panel-nav">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Kemaskini Projek
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhasanyrole

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-borderless">
                            <div class="panel-heading panel-dark">
                                Maklumat Asas
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered font-std">
                                            <tr class="info">
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
                                                <th class="col-md-3 min100">Tujuan</th>
                                                <td>{!! $project->initial_purpose ?? 'N/A' !!}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-3 min100">Skop</th>
                                                <td>{!! $project->initial_scope ?? 'N/A' !!}</td>
                                            </tr>
                                            {{-- <tr>
                                                <th class="col-md-3 min100">Konsep</th>
                                                <td>{!! $project->initial_concept ?? 'N/A' !!}</td>
                                            </tr> --}}
                                            <tr>
                                                <th class="col-md-3 min100">Anggaran Kos (RM)</th>
                                                <td>{{ currency($project->estimate_cost) ?? '0.00' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-3 min100">Tarikh Kelulusan JPICT</th>
                                                <?php 
                                                    $approval_date = '';

                                                    if (!empty($project->approval_date)) {
                                                        $approval_date = $project->approval_date->format('d/m/Y');
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
                                                <th class="col-md-3 min100">Kategori</th>
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
                                                                    <a href="{{ url('storage/projects/' . $project->id . '/' . $data->file_name) }}">
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
                                                <!--
                                                @if ($project->status !== 10)
                                                    <th class="col-md-3 min100">Status</th>
                                                    <td> @include('components._status') </td>
                                                @endif
                                                -->
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (\Auth::user()->hasRole('ks'))
                            @if (\App\Helpers\Status::project_application($project->status))
                                {{ Form::open(['method' => 'POST']) }}
                                    <div class="panel panel-borderless">
                                        <div class="panel-heading panel-dark">
                                            Semakan dan Sokongan
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Komen</label>
                                                            <textarea class="form-control texteditor" name="review_content" cols="30" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mrg10B mrg10T pull-right">
                                                            <div class="btn-group">
                                                                <button class="btn btn-success" type="submit" formaction="{{ route('reviews.approve.ks', $project->id) }}">Terima Permohonan</button>
                                                                <button class="btn btn-warning" type="submit" formaction="{{ route('reviews.kiv.ks', $project->id) }}">Mohon Pindaan</button>
                                                                <button class="btn btn-danger" type="submit" formaction="{{ route('reviews.reject.ks', $project->id) }}">Tolak Permohonan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{ Form::close() }}
                            @endif
                        @endif

                        @if (\Auth::user()->hasRole('sub'))
                            @if (\App\Helpers\Status::initial_approved_by_ks($project->status))
                                {{ Form::open(['method' => 'POST']) }}
                                    <div class="panel panel-borderless">
                                        <div class="panel-heading panel-dark">
                                            Semakan dan Sokongan
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Komen</label>
                                                            <textarea class="form-control texteditor" name="review_content" cols="30" rows="5"></textarea>
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
                                                    <button class="btn btn-success" type="submit" formaction="{{ route('reviews.approve.sub', $project->id) }}">Terima Permohonan</button>
                                                    <button class="btn btn-warning" type="submit" formaction="{{ route('reviews.kiv.sub', $project->id) }}">Mohon Pindaan</button>
                                                    <button class="btn btn-danger" type="submit" formaction="{{ route('reviews.reject.sub', $project->id) }}">Tolak Permohonan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{ Form::close() }}
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push ('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script>
        $(function () {
            $('.texteditor').summernote({
                toolbar: [],
                height: 100
            });
        });
    </script>
@endpush
