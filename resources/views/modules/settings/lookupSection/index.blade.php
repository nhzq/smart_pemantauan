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
                        <h3 class="box-title">List of Sections</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="tbl-row-ini tbl-default">
                                        <th>#</th>
                                        <th>Displayed Name</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($sections))
                                        @foreach ($sections as $section)
                                            <tr>
                                                <th class="col-md-2">{{ $loop->iteration }}</th>
                                                <td class="col-md-4">{{ $section->displayed_name }}</td>
                                                <td class="col-md-4">{{ $section->name }}</td>
                                                <td class="col-md-2">
                                                    <div class="min90">
                                                        <div class="btn-group">
                                                            <a href="{{ route('sections.edit', $section->id) }}" class="btn bg-purple">
                                                                <i class="fa fa-fw fa-pencil-square-o"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">No Records Found</td>
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