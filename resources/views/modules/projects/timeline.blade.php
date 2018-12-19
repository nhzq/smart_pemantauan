@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/table.css') }}">
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
                        Semakan dan Komen
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            @include ('modules.projects.shared._comments')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
