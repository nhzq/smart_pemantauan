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
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Pengesahan
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="row">
                                @hasanyrole ('ku')
                                    <div class="form-horizontal">                                  
                                        {{ Form::open(['url' => route('verifications.store', $project->id), 'method' => 'POST']) }}
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label class="col-sm-3 control-label">Nama Pegawai </label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="text" name="verification_name" value="{{ \Auth::user()->name }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label class="col-sm-3 control-label">Jawatan Pegawai</label>
                                                    <div class="col-sm-9">
                                                        <input class="form-control" type="text" name="verification_position" value="{{ implode((\Auth::user()->roles->pluck('displayed_name')->toArray()), ', ') }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label class="col-sm-3 control-label">Tarikh Pengesahan</label>
                                                    <div class="col-sm-9">
                                                        @if (\App\Helpers\Status::toPlanningPhase($project->status) || \App\Helpers\Status::planningRejectedByKS($project->status))
                                                            <input class="pickdate form-control" type="text" name="verification_date" placeholder="Tarikh" value="{{ \Carbon\Carbon::now()->format('m/d/Y') }}">
                                                        @endif

                                                        @if (\App\Helpers\Status::planningByKU($project->status))
                                                            <input class="form-control" type="text" value="{{ \Carbon\Carbon::now()->format('m/d/Y') }}" readonly>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-2 mrg20B mrg20T pull-right">
                                                        @if (\App\Helpers\Status::toPlanningPhase($project->status) || \App\Helpers\Status::planningRejectedByKS($project->status))
                                                            <button class="btn btn-block btn-primary" type="submit">
                                                                Hantar
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        {{ Form::close() }}                                    
                                    </div>
                                @endhasanyrole

                                @hasanyrole ('ks')
                                    <?php
                                        $user = \App\Models\User::find($project->verified_by);
                                    ?>

                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <tr class="tbl-row-init tbl-default">
                                                <th class="col-md-3 min100">&nbsp;</th>
                                                <th>Maklumat Pengesahan</th>
                                            </tr>
                                            <tr>
                                                <th class="col-md-3 min100">Nama Pegawai</th>
                                                <td>{{ $user->name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-3 min100">Jawatan Pegawai</th>
                                                <td>{{ $user->roles->pluck('displayed_name')->first() }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-3 min100">Tarikh Pengesahan</th>
                                                <?php 
                                                    $verify_date = '';

                                                    if (!empty($project->verification_date)) {
                                                        $verify_date = $project->verification_date->format('m/d/Y');
                                                    }
                                                ?>
                                                <td>{{ $verify_date }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endhasanyrole
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push ('script')
    <script>
        $('.pickdate').datepicker({
            autoclose: true
        });
    </script>
@endpush
