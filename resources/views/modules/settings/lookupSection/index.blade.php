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
                        Senarai Seksyen
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered font-std">
                                <thead>
                                    <tr class="info">
                                        <th class="text-center col-sm-1">#</th>
                                        <th class="text-center col-sm-5">Nama Paparan</th>
                                        <th class="text-center col-sm-5">Nama (kod)</th>
                                        <th class="col-sm-1">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($sections))
                                        @foreach ($sections as $section)
                                            <tr>
                                                <th class="text-center align-center">{{ $loop->iteration }}</th>
                                                <td class="align-center">{{ $section->displayed_name ?? 'N/A' }}</td>
                                                <td class="align-center">{{ $section->name ?? 'N/A' }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-sm bg-purple">
                                                            <i class="fa fa-fw fa-pencil-square-o"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">Tiada Rekod Dijumpai</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="pull-right">
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