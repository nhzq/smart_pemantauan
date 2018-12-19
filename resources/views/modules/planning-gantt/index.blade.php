@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/plugin/gantt/css/style.css') }}">

    <style type="text/css">
        /* Bootstrap 3.x re-reset */
        .fn-gantt *,
        .fn-gantt *:after,
        .fn-gantt *:before {
        -webkit-box-sizing: content-box;
           -moz-box-sizing: content-box;
                box-sizing: content-box;
        }
    </style>
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
                        Carta Gantt
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="gantt" style="margin-top: 0px !important;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push ('script')
    <script src={{ asset('adminlte/plugin/gantt/js/jquery.fn.gantt.js') }}></script>
    {{-- <script>
        $(function () {
            var activity = {!! $activity !!};

            var data = [];

            for (var i = 0; i < Object.keys(activity).length; i++) {
                data.push({
                    'name': activity[i].id
                });
            }

            console.log(data)
        });
    </script> --}}

    <script>
        $(function() {
            var data = {!! $data !!};

            "use strict";

            $(".gantt").gantt({
                source: data,
                navigate: "scroll",
                maxScale: "hours",
                itemsPerPage: 10,
                onRender: function() {
                    if (window.console && typeof console.log === "function") {
                        console.log("chart rendered");
                    }
                }
            });
        });
    </script>
@endpush
