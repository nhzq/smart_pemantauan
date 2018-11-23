@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/table.css') }}">
@endpush

@section ('content')
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Senarai Unit</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="tbl-row-init tbl-default">
                                        <th class="col-md-1">#</th>
                                        <th class="col-md-3">Seksyen</th>
                                        <th class="col-md-3">Nama Paparan</th>
                                        <th class="col-md-1">Nama (kod)</th>
                                        <th class="col-md-1">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($units))
                                        @foreach ($units as $unit)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $unit->section->displayed_name ?? 'N/A' }}</td>
                                                <td>{{ $unit->displayed_name ?? 'N/A' }}</td>
                                                <td>{{ $unit->name ?? 'N/A' }}</td>
                                                <td>
                                                    <div class="min90">
                                                        <div class="btn-group">
                                                            <a href="{{ route('units.edit', $unit->id) }}" class="btn bg-purple">
                                                                <i class="fa fa-fw fa-pencil-square-o"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="6"></td>
                                        </tr>
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