@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
@endpush

@section ('content')
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Senarai Unit
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered font-std">
                                <thead>
                                    <tr class="info">
                                        <th class="col-md-1 text-center">#</th>
                                        <th class="col-md-3 text-center">Seksyen</th>
                                        <th class="col-md-3 text-center">Nama Paparan</th>
                                        <th class="col-md-1 text-center">Nama (kod)</th>
                                        <th class="col-md-1">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($units))
                                        @foreach ($units as $unit)
                                            <tr>
                                                <th class="text-center align-center">{{ $loop->iteration }}</th>
                                                <td class="align-center">{{ $unit->section->displayed_name ?? 'N/A' }}</td>
                                                <td class="align-center">{{ $unit->displayed_name ?? 'N/A' }}</td>
                                                <td class="align-center">{{ $unit->name ?? 'N/A' }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-sm bg-purple">
                                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                                        </a>
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