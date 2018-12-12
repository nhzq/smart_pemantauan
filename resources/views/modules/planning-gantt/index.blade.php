@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/table.css') }}">
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
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Carta Gantt</h3>
                    </div>
                    <div class="box-body">
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
            var activity = {!! $activity !!};

            var data = [];

            for (var i = 0; i < Object.keys(activity).length; i++) {
                var parent = '';
                var child = ''

                if (activity[i].parent_id == 0) {
                    parent = activity[i].activity;
                } else {
                    child = activity[i].activity;
                }

                data.push({
                    name: parent,
                    desc: child,
                    values: [{
                        from: "/Date(1320192000000)/",
                        to: "/Date(1322401600000)/",
                        label: "",
                        customClass: "ganttGreen"
                    }]
                });
            }

            "use strict";

            $(".gantt").gantt({
                source: data,
                navigate: "scroll",
                maxScale: "hours",
                itemsPerPage: 10,
                onItemClick: function(data) {
                    alert("Item clicked - show some details");
                },
                onAddClick: function(dt, rowId) {
                    alert("Empty space clicked - add an item!");
                },
                onRender: function() {
                    if (window.console && typeof console.log === "function") {
                        console.log("chart rendered");
                    }
                }
            });

            // $(".gantt").gantt({
            //     source: [{
            //         name: "Perancangan",
            //         desc: "Daftar Projek",
            //         values: [{
            //             from: "/Date(1320192000000)/",
            //             to: "/Date(1322401600000)/",
            //             label: "Daftar Projek",
            //             customClass: "ganttRed"
            //         }]
            //     }, {
            //         name: " ",
            //         desc: "Sah Brif Projek",
            //         values: [{
            //             from: "/Date(1322611200000)/",
            //             to: "/Date(1323302400000)/",
            //             label: "Sah Brif Projek",
            //             customClass: "ganttRed"
            //         }]
            //     }, {
            //         name: "Rekabentuk",
            //         desc: "Terima Lukisan Set Pertama Projek",
            //         values: [{
            //             from: "/Date(1323802400000)/",
            //             to: "/Date(1325685200000)/",
            //             label: "Terima Lukisan Set Pertama Projek",
            //             customClass: "ganttGreen"
            //         }]
            //     },{
            //         name: " ",
            //         desc: "Set Lukisan Lengkap Projek",
            //         values: [{
            //             from: "/Date(1325685200000)/",
            //             to: "/Date(1325695200000)/",
            //             label: "Set Lukisan Lengkap Projek",
            //             customClass: "ganttBlue"
            //         }]
            //     },{
            //         name: "Pembinaan",
            //         desc: "Perlaksanaan Projek",
            //         values: [{
            //             from: "/Date(1326785200000)/",
            //             to: "/Date(1325785200000)/",
            //             label: "Perlaksanaan Projek",
            //             customClass: "ganttGreen"
            //         }]
            //     },{
            //         name: " ",
            //         desc: "Perakuan Siap Kerja",
            //         values: [{
            //             from: "/Date(1328785200000)/",
            //             to: "/Date(1328905200000)/",
            //             label: "Perakuan Siap Kerja",
            //             customClass: "ganttBlue"
            //         }]
            //     }],
            //     navigate: "scroll",
            //     maxScale: "hours",
            //     itemsPerPage: 10,
            //     onItemClick: function(data) {
            //         alert("Item clicked - show some details");
            //     },
            //     onAddClick: function(dt, rowId) {
            //         alert("Empty space clicked - add an item!");
            //     },
            //     onRender: function() {
            //         if (window.console && typeof console.log === "function") {
            //             console.log("chart rendered");
            //         }
            //     }
            // });

            $(".gantt").popover({
                selector: ".bar",
                title: "I'm a popover",
                content: "And I'm the content of said popover.",
                trigger: "hover"
            });

        });
    </script>
@endpush
