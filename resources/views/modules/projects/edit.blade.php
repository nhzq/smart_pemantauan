@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
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
                        Projek Baru
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['url' => route('projects.update', $project->id), 'enctype' => 'multipart/form-data', 'method' => 'PUT']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('project_name') ? 'has-error' : '' }}">
                                            <label>Jenis Bajet</label>
                                            <select id="project_budget_type" class="form-control" name="project_budget_type">
                                                <option value="0">-- Sila Pilih --</option>
                                                @foreach ($budgets as $data)
                                                    <?php
                                                        $selected = '';

                                                        if ($project->lookup_budget_type_id == $data->id) {
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                    @if ($data->code == 'B01')
                                                        <option value="{{ $data->id }}" {{ $selected }}>{{ $data->code . ' : ' . $data->description }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('project_name') ? 'has-error' : '' }}">
                                            <label>Butiran</label>
                                            <select id="project_sub_budget_type" class="form-control" name="project_sub_budget_type">
                                                <option value="0">-- Sila Pilih --</option>
                                                @foreach ($subBudgets as $data)
                                                    <?php
                                                        $selected = '';

                                                        if ($project->lookup_sub_budget_type_id == $data->id) {
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                    <option value="{{ $data->id }}" {{ $selected }}>{{ $data->code . ' : ' . $data->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('project_name') ? 'has-error' : '' }}">
                                            <label>Nama Projek</label>
                                            <input class="form-control" type="text" name="project_name" placeholder="Nama Projek" value="{{ $project->name ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('project_file_reference') ? 'has-error' : '' }}">
                                            <label>No Rujukan Fail</label>
                                            <input class="form-control" type="text" name="project_file_reference" placeholder="No Rujukan Fail" value="{{ $project->file_reference_no ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('project_purpose') ? 'has-error' : '' }}">
                                            <label>Tujuan</label>
                                            <textarea class="form-control texteditor" name="project_purpose" cols="30" rows="5">{!! $project->initial_purpose ?? '' !!}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('project_scope') ? 'has-error' : '' }}">
                                            <label>Skop</label>
                                            <textarea class="form-control texteditor" name="project_scope" cols="30" rows="5">{!! $project->initial_scope ?? '' !!}</textarea>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Konsep</label>
                                            <textarea class="form-control texteditor" name="project_concept" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('project_description') ? 'has-error' : '' }}">
                                            <label>Anggaran Kos (RM)</label>
                                            <input class="form-control money-convert" type="text" name="project_estimate_cost" placeholder="Anggaran Kos (RM)" value="{{ currency($project->estimate_cost) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('project_description') ? 'has-error' : '' }}">
                                            <label>Tarikh Kelulusan JPICT</label>
                                            <input id="datepicker" class="form-control" type="text" name="project_approval_date" placeholder="Tarikh Kelulusan JPICT" value="{{ $project->approval_date->format('d/m/Y') ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="rmk">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group {{ $errors->has('project_rmk') ? 'has-error' : '' }}">
                                                <label>RMK</label>
                                                <textarea id="project_rmk" class="form-control" name="project_rmk" cols="30" rows="5">{{ $project->rmk ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('project_proposal_files') ? 'has-error' : '' }}">
                                            <label>Kertas Cadangan</label>
                                            {{-- @if (count($project->documents) > 0)
                                                <ul class="list-group">
                                                    @foreach ($project->documents as $data)
                                                        @if ($data->category == 'kertas-cadangan')
                                                            <li class="list-group-item">
                                                                {{ $data->original_name ?? '' }}
                                                                <span class="pull-right">
                                                                    <a href="{{ route('projects.destroy.file', [$project->id, $data->id]) }}">Hapus</a>
                                                                </span>
                                                            </li>
                                                        @endif
                                                    @endforeach 
                                                </ul>
                                            @endif --}}
                                            <input class="form-control" type="file" name="project_proposal_files">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Adakah projek ini melakukan Kajian Pasaran?</label>
                                        <div class="radio" style="margin-top: 0px !important">
                                            <label class="radio-inline"><input type="radio" name="optradio" value="1" {{ $project->market_research == 1 ? 'checked' : '' }}>Ya</label>
                                            <label class="radio-inline"><input type="radio" name="optradio" value="2" {{ $project->market_research == 2 ? 'checked' : '' }}>Tidak</label>
                                        </div>
                                    </div>
                                </div>

                                <div id="radio-research">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('project_description') ? 'has-error' : '' }}">
                                                <label>Jika Ya</label>
                                                <input class="form-control" type="file" name="project_market_research_files">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 mrg20B pull-right">
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
    <script src="{{ asset('adminlte/plugin/maskMoney/jquery.maskMoney.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.texteditor').summernote({
                toolbar: [],
                height: 100
            });
            $('.money-convert').maskMoney();
            
            $('#rmk').hide();
            $('#radio-research').hide();

            $('#datepicker').datepicker({
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            if ($("#project_rmk").val() !== '') {
                $('#rmk').show();
            }

            $('#project_budget_type').on('change', function () {
                var selected_value = $(this).val();
                var type = '';

                $.ajax({
                    type: 'GET',
                    datatype: 'json',
                    url: '{{ route('projects.create.sub') }}',
                    data: {
                        'id': selected_value
                    },
                    success: function (data) {
                        type += '<option value="0">-- Sila Pilih --</option>';

                        for (var i = 0; i < data.length; i++) {
                            type += '<option value="' + data[i].id + '">' + data[i].code + ' : ' + data[i].description + '</option>';
                        }

                        $('#project_sub_budget_type').html(" ");
                        $('#project_sub_budget_type').append(type);
                    },
                    error: function (xhr, desc, err) {
                        console.log('error');
                    }
                });

                if (selected_value == 1) {
                    $('#rmk').toggle();
                } else {
                    $("#project_rmk").val('');
                    $('#rmk').hide();
                }
            });

            if ($('input[name=optradio]').val() == 1) {
                $('#radio-research').toggle();
            } else {
                $('#radio-research').hide();
            }

            $('input[name=optradio]').on('change', function () {
                selected_value = $(this).val();

                if (selected_value == 1) {
                    $('#radio-research').toggle();
                } else {
                    $('#radio-research').hide();
                }
            });
            
        });
    </script>
@endpush
