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

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Maklumat Kaedah Perolehan</h3>
                    </div>
                    
                    <div class="box-body">
                        {{ Form::open(['url' => route('methods.store', $project->id), 'method' => 'POST']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            @if ($project->lookup_collection_type_id == 2)
                                                <label>No Sebutharga B</label>
                                            @endif
                                            @if ($project->lookup_collection_type_id == 3)
                                                <label>No Sebutharga</label>
                                            @endif
                                            @if ($project->lookup_collection_type_id == 4)
                                                <label>No Tender</label>
                                            @endif

                                            <input class="form-control" type="text" name="method_file_no" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            @if ($project->lookup_collection_type_id == 2)
                                                <label>Tarikh Mesyuarat Jawatankuasa Sebutharga B</label>
                                            @endif
                                            @if ($project->lookup_collection_type_id == 3)
                                                <label>Tarikh Mesyuarat Jawatankuasa Sebutharga Pejabat SUK Selangor</label>
                                            @endif
                                            @if ($project->lookup_collection_type_id == 4)
                                                <label>Tarikh Mesyuarat Lembaga Perolehan Negeri</label>
                                            @endif

                                            <input class="form-control pickdate" type="text" name="method_meeting_date">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            @if ($project->lookup_collection_type_id == 2)
                                                <label>Tarikh Buka Sebutharga B</label>
                                            @endif
                                            @if ($project->lookup_collection_type_id == 3)
                                                <label>Tarikh Buka Sebutharga</label>
                                            @endif
                                            @if ($project->lookup_collection_type_id == 4)
                                                <label>Tarikh Buka Tender</label>
                                            @endif

                                            <input id="start_date" class="form-control" type="text" name="method_open_date">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            @if ($project->lookup_collection_type_id == 2)
                                                <label>Tarikh Tutup Sebutharga B</label>
                                            @endif
                                            @if ($project->lookup_collection_type_id == 3)
                                                <label>Tarikh Tutup Sebutharga</label>
                                            @endif
                                            @if ($project->lookup_collection_type_id == 4)
                                                <label>Tarikh Tutup Tender</label>
                                            @endif

                                            <input id="end_date" class="form-control" type="text" name="method_close_date">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            @if ($project->lookup_collection_type_id == 2)
                                                <label>Tempoh Sah Tawaran Sebutharga B</label>
                                            @endif
                                            @if ($project->lookup_collection_type_id == 3)
                                                <label>Tempoh Sah Tawaran Sebutharga</label>
                                            @endif
                                            @if ($project->lookup_collection_type_id == 4)
                                                <label>Tempoh Sah Tawaran Tender</label>
                                            @endif

                                            <input id="total_days" class="form-control" type="text" name="method_duration" readonly>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-2 pull-right mrg20T">
                                <button class="btn btn-block btn-primary" type="submit">
                                    Simpan
                                </button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@push ('script')
    <script type="text/javascript">
        $(function () {
            $('.pickdate').datepicker({
                todayHighlight: true,
                autoclose: true
            });

            $('#start_date').datepicker({
                todayHighlight: true,
                autoclose: true
            }).on('changeDate', function (e) {
                $('#end_date').datepicker('setStartDate', $('#start_date').val());
            });

            $('#end_date').datepicker({
                todayHighlight: true,
                autoclose: true
            }).on('changeDate', function (e) {
                var start = $('#start_date').val();
                var startD = new Date(start);

                var end = $('#end_date').val();
                var endD = new Date(end);

                var diff = parseInt(((endD.getTime() - startD.getTime()) / (24*3600*1000)) + 1);

                $('#total_days').val(diff);
            });
        });
    </script>
@endpush