@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
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
                        <h3 class="box-title">Maklumat Asas</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <tr>
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
                                        <td>{{ $project->concept ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Anggaran Kos (RM)</th>
                                        <td>{{ $project->estimate_cost ?? '0.00' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Tarikh Kelulusan JPICT</th>
                                        <td>{{ $project->approval_date ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Kertas Cadangan</th>
                                        <td><a href="">{{ $project->proposal ?? 'N/A' }}</a></td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Jenis Bajet</th>
                                        <td>{{ $project->lookup_budget_type_id ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Jenis Sub Bajet</th>
                                        <td>{{ $project->lookup_sub_budget_type_id ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-3 min100">Status</th>
                                        <td> @include('components._status') </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                @include ('modules.reviews.shared._comments')
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
