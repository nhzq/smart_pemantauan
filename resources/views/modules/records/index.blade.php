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
                @hasanyrole ('ku')
                    <div class="panel panel-borderless">
                        <div class="panel-body panel-nav">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <a href="{{ route('records.create', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Kemaskini Rekod
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
                                Rekod-rekod disenggara
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered font-std">
                                        <tr class="info">
                                            <th class="col-md-3">&nbsp;</th>
                                            <th>Maklumat</th>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Jenis Rekod</th>
                                            <td>{{ $project->record->record_type ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Pegawai Bertanggungjawab</th>
                                            <td>{{ $project->record->authorized_officer ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-md-5">Lokasi Simpanan Rekod</th>
                                            <td>{{ $project->record->record_location ?? '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push ('script')
@endpush
