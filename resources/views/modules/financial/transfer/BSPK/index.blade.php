@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
@endpush

@section ('content')
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-borderless">
                    <div class="panel-body panel-nav">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-sm-2" style="padding-left: 0;">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <select class="form-control">
                                            <option>2018</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button class="btn btn-diamond" data-toggle="collapse" data-target="#search" type=""><i class="fa fa-fw fa-search"></i> Carian</button>
                                        <a href="" class="btn btn-diamond">
                                            <i class="fa fa-fw fa-plus"></i> Pindah Peruntukan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Pindah Peruntukan BSPK
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="font-p">
                                    <tr class="info">
                                        <th class="text-center align-center">#</th>
                                        <th class="text-center align-center">Tarikh Kelulusan</th>
                                        <th class="text-center align-center">Dari Projek</th>
                                        <th class="text-center align-center">Ke Projek</th>
                                        <th class="text-center align-center">No Waran</th>
                                        <th class="text-center align-center">Tarikh Waran</th>
                                        <th class="text-center align-center">Tujuan</th>
                                        <th class="text-center align-center">Jumlah Pindah Peruntukan &nbsp;<span class="label bck-diamond">RM</span></th>
                                        {{-- <th>Tindakan</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="font-std">
                                    
                                </tbody>
                            </table>
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