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
                        <?php 
                            $details = '';

                            if ($id == 1) {
                                $details = 'Jawatankuasa Spesifikasi Teknikal';
                            } else if ($id == 2) {
                                $details = 'Jawatankuasa Penilaian Teknikal';
                            } else {
                                $details = 'Jawatankuasa Penilaian Harga';
                            }
                        ?>
                        Maklumat {{ $details }}
                    </div>
                    
                    <div class="panel-body">
                        {{ Form::open(['url' => route('committees.update.information', [$project_id, $id]), 'method' => 'PUT', ' enctype' => 'multipart/form-data']) }}
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tarikh Lantikan Jawatan</label>
                                            <input class="form-control pickdate" type="text" name="committee_appointment_date" value="{{ isset($info) ? $info->appointment_date->format('m/d/Y') : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Muatnaik Surat Lantikan</label>
                                            <input class="form-control" type="file" name="committee_appointment_letter">
                                        </div>
                                    </div>
                                </div>
                                
                                @if ($id == 1)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Muatnaik Spesifikasi Teknikal dan Harga</label>
                                            <input class="form-control" type="file" name="committee_spec_document">
                                        </div>
                                    </div>
                                @endif
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
        });
    </script>
@endpush
