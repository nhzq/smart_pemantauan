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
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Maklumat Kaedah Perolehan
                    </div>
                    
                    <div class="panel-body">
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

                                            <input class="form-control" type="text" name="method_file_no" value="{{ $project->collection_file_no ?? '' }}">
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

                                            <input class="form-control pickdate" 
                                                type="text" 
                                                name="method_meeting_date" 
                                                value="{{ !empty($project->collection_meeting_date) ? $project->collection_meeting_date->format('d/m/Y') : '' }}"
                                            >
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

                                            <input id="start_date" class="form-control" 
                                                type="text" 
                                                name="method_open_date"
                                                value="{{ !empty($project->collection_open_date) ? $project->collection_open_date->format('d/m/Y') : '' }}"
                                            >
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

                                            <input id="end_date" class="form-control" 
                                                type="text" 
                                                name="method_close_date"
                                                value="{{ !empty($project->collection_close_date) ? $project->collection_close_date->format('d/m/Y') : '' }}"
                                            >
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
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            $('#start_date').datepicker({
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                autoclose: true
            }).on('changeDate', function (e) {
                $('#end_date').datepicker('setStartDate', $('#start_date').val());
            });

            $('#end_date').datepicker({
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                autoclose: true
            }).on('changeDate', function (e) {
                var startD = $("#start_date").datepicker('getDate');
                var endD = $("#end_date").datepicker('getDate');

                var diff = Math.round(((endD.getTime() - startD.getTime()) / (1000*60*60*24)) + 1);

                $('#total_days').val('');
                $('#total_days').val(diff);
            });
        });
    </script>
@endpush