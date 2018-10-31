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
        
        <div class="row mrg10T">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title"><strong>{{ $project->name ?? 'N/A' }}</strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th class="col-md-3 min100">&nbsp;</th>
                                    <th>Details</th>
                                </tr>
                                <tr>
                                    <th class="col-md-3 min100">Project</th>
                                    <td>{{ $project->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-3 min100">Cost</th>
                                    <td>RM {{ helperCurrency($project->cost) ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-3 min100">Description</th>
                                    <td>{{ $project->description ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                @include ('modules.reviews.shared._submit')
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
