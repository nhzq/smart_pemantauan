@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/panel-tab.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
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
                        Maklumat Kontraktor
                        <span class="pull-right">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">Perlantikan Kontraktor</a></li>
                                <li><a href="#tab2" data-toggle="tab">Maklumat Syarikat</a></li>
                                <li><a href="#tab3" data-toggle="tab">Senarai Kontraktor</a></li>
                                <li><a href="#tab4" data-toggle="tab">Tempoh Kontrak</a></li>
                            </ul>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <!-- Perlantikan Kontraktor -->
                            <div class="tab-pane active" id="tab1">
                                {{ Form::open(['url' => route('contractors.appointment.store', $project->id), 'method' => 'POST']) }}
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tarikh Surat Setuju Terima (SST)</label>
                                                    <?php 
                                                        $contractor_sst = '';

                                                        if (!empty($project->contractorAppointment->sst)) {
                                                            $contractor_sst = $project->contractorAppointment->sst->format('d/m/Y');
                                                        }
                                                    ?>
                                                    <input class="form-control pickdate" 
                                                        type="text" 
                                                        name="contractor_sst" 
                                                        value="{{ $contractor_sst }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>No. Rujukan SST</label>
                                                    <input class="form-control" 
                                                        type="text" 
                                                        name="contractor_sst_reference" 
                                                        value="{{ $project->contractorAppointment->sst_reference_no ?? '' }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Harga Kontrak</label>
                                                    <input class="form-control money-convert" 
                                                        type="text" 
                                                        name="contractor_value" 
                                                        value="{{ currency($project->actual_project_cost) }}" 
                                                        readonly
                                                    >
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
                            
                            <!-- Maklumat Syarikat -->
                            <div class="tab-pane" id="tab2">
                                {{ Form::open(['url' => route('contractors.details.store', $project->id), 'method' => 'POST']) }}
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>No Sijil SSM</label>
                                                    <input class="form-control" type="text" name="contractor_ssm" value="{{ $project->contractorAppointment->ssm_no ?? '' }}">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>No Rujukan Pendaftaran SSM</label>
                                                    <input class="form-control" 
                                                        type="text" 
                                                        name="contractor_ssm_reference" 
                                                        value="{{ $project->contractorAppointment->ssm_reference_no ?? '' }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tempoh Sah Laku</label>
                                                    <div class="input-group">

                                                        <?php 
                                                            $contractor_ssm_start_date = '';

                                                            if (!empty($project->contractorAppointment->ssm_start_date)) {
                                                                $contractor_ssm_start_date = $project->contractorAppointment->ssm_start_date->format('d/m/Y');
                                                            }
                                                        ?>
                                                        <input class="form-control pickdate" 
                                                            type="text" 
                                                            name="contractor_ssm_start_date" 
                                                            value="{{ $contractor_ssm_start_date }}"
                                                        >
                                                        <span class="input-group-addon"><i class="fa fa-arrow-right"></i></span>

                                                        <?php 
                                                            $contractor_ssm_end_date = '';

                                                            if (!empty($project->contractorAppointment->ssm_end_date)) {
                                                                $contractor_ssm_end_date = $project->contractorAppointment->ssm_end_date->format('d/m/Y');
                                                            }
                                                        ?>
                                                        <input class="form-control pickdate" 
                                                            type="text" 
                                                            name="contractor_ssm_end_date" 
                                                            value="{{ $contractor_ssm_end_date }}"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>No Sijil MOF</label>
                                                    <input class="form-control" type="text" name="contractor_mof" value="{{ $project->contractorAppointment->mof_no ?? '' }}">
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>No Rujukan Pendaftaran MOF</label>
                                                    <input class="form-control" 
                                                        type="text" 
                                                        name="contractor_mof_reference" 
                                                        value="{{ $project->contractorAppointment->mof_reference_no ?? '' }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tempoh Sah Laku</label>
                                                    <div class="input-group">

                                                        <?php 
                                                            $contractor_mof_start_date = '';

                                                            if (!empty($project->contractorAppointment->mof_start_date)) {
                                                                $contractor_mof_start_date = $project->contractorAppointment->mof_start_date->format('d/m/Y');
                                                            }
                                                        ?>
                                                        <input class="form-control pickdate" 
                                                            type="text" 
                                                            name="contractor_mof_start_date" 
                                                            value="{{ $contractor_mof_start_date }}"
                                                        >
                                                        <span class="input-group-addon"><i class="fa fa-arrow-right"></i></span>

                                                        <?php 
                                                            $contractor_mof_end_date = '';

                                                            if (!empty($project->contractorAppointment->mof_end_date)) {
                                                                $contractor_mof_end_date = $project->contractorAppointment->mof_end_date->format('d/m/Y');
                                                            }
                                                        ?>
                                                        <input class="form-control pickdate" 
                                                            type="text" 
                                                            name="contractor_mof_end_date" 
                                                            value="{{ $contractor_mof_end_date }}"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Nama Syarikat</label>
                                                    <input class="form-control" 
                                                        type="text" 
                                                        name="contractor_company_name" 
                                                        value="{{ $project->contractorAppointment->company_name ?? '' }}"
                                                    >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Alamat Syarikat</label>
                                                    <textarea class="form-control texteditor" type="text" name="contractor_company_address">
                                                        {!! $project->contractorAppointment->company_address ?? '' !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>No Telefon</label>
                                                    <input class="form-control" 
                                                        type="text" 
                                                        name="contractor_company_tel" 
                                                        value="{{ $project->contractorAppointment->company_tel ?? '' }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>No Fax</label>
                                                    <input class="form-control" 
                                                        type="text" 
                                                        name="contractor_company_fax" 
                                                        value="{{ $project->contractorAppointment->company_fax ?? '' }}"
                                                    >
                                                </div>
                                            </div>

                                            {{-- <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Bilangan Kontraktor</label>
                                                    <input class="form-control" type="text" name="contractor_count" readonly>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-2 pull-right mrg20T">
                                        <button class="btn btn-block btn-primary" type="submit">
                                            Simpan
                                        </button>
                                    </div>
                                {{ Form::close() }}
                            </div>
                            
                            <!-- Senarai Kontraktor -->
                            <div class="tab-pane" id="tab3">
                                {{ Form::open(['url' => route('contractors.lists.store', $project->id), 'method' => 'POST']) }}
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered" id="item_table">
                                                <tr class="info">
                                                    <th class="col-sm-3" style="vertical-align: middle;">Nama</th>
                                                    <th class="col-sm-2" style="vertical-align: middle;">Jawatan</th>
                                                    <th class="col-sm-2" style="vertical-align: middle;">No MyKad</th>
                                                    <th class="col-sm-2" style="vertical-align: middle;">Email</th>
                                                    <th class="col-sm-2" style="vertical-align: middle;">No Telefon</th>
                                                    <th class="col-sm-1">
                                                        <button type="button" name="add" class="btn btn-diamond btn-sm add"><span class="glyphicon glyphicon-plus"></span></button>
                                                    </th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-2 pull-right mrg20T">
                                        <button class="btn btn-block btn-primary" type="submit">
                                            Simpan
                                        </button>
                                    </div>
                                {{ Form::close() }}
                            </div>
                            
                            <!-- Tempoh Kontrak -->
                            <div class="tab-pane" id="tab4">
                                {{ Form::open(['url' => route('contractors.duration.store', $project->id), 'method' => 'POST']) }}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tempoh Sah Laku</label>
                                            <div class="input-group">

                                                <?php 
                                                    $contractor_duration_start_date = '';

                                                    if (!empty($project->contractorAppointment->contract_start_date)) {
                                                        $contractor_duration_start_date = $project->contractorAppointment->contract_start_date->format('d/m/Y');
                                                    }
                                                ?>
                                                <input class="form-control pickdate" 
                                                    type="text" 
                                                    name="contractor_duration_start_date"
                                                    value="{{ $contractor_duration_start_date }}"
                                                >
                                                <span class="input-group-addon"><i class="fa fa-arrow-right"></i></span>

                                                <?php 
                                                    $contractor_duration_end_date = '';

                                                    if (!empty($project->contractorAppointment->contract_end_date)) {
                                                        $contractor_duration_end_date = $project->contractorAppointment->contract_end_date->format('d/m/Y');
                                                    }
                                                ?>
                                                <input class="form-control pickdate" 
                                                    type="text" 
                                                    name="contractor_duration_end_date"
                                                    value="{{ $contractor_duration_end_date }}"
                                                >
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
            </div>
        </div>
    </section>
@endsection

@push ('script')
    <script src="{{ asset('adminlte/plugin/maskMoney/jquery.maskMoney.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script>
        $(function () {
            var hash = document.location.hash;
            var prefix = "tab_";
            if (hash) {
                $('.panel-tabs a[href="'+hash.replace(prefix,"")+'"]').tab('show');
            } 

            // Change hash for page-reload
            $('.panel-tabs a').on('shown.bs.tab', function (e) {
                window.location.hash = e.target.hash.replace("#", "#" + prefix);
            });
        });
    </script>

    <script>
        $(function () {
            $(document).on('click', '.add', function () {
                var html = '';

                html += '<tr>';
                html += '<td><input type="text" name="contractor_name[]" class="form-control contractor_name" /></td>';
                html += '<td><input type="text" name="contractor_position[]" class="form-control contractor_position" /></td>';
                html += '<td><input type="text" name="contractor_ic[]" class="form-control contractor_ic" /></td>';
                html += '<td><input type="text" name="contractor_email[]" class="form-control contractor_email" /></td>';
                html += '<td><input type="text" name="contractor_tel[]" class="form-control contractor_tel" /></td>';
                html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';

                $('#item_table').append(html);
            });

            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>

    <script>
        $(function () {
            $('.money-convert').maskMoney();

            $('.pickdate').datepicker({
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            $('.texteditor').summernote({
                toolbar: [],
                height: 100
            });
        });
    </script>
@endpush
