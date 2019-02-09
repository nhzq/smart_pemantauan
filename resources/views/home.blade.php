@extends ('layouts.master')

@section ('content')
    <!-- Content Header (Page header) -->
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Senarai Peruntukan
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-2">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>1</h3>      
                                        <p>Senarai Projek</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-2">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>1</h3>      
                                        <p>Senarai Projek</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-2">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>1</h3>      
                                        <p>Senarai Projek</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-2">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>1</h3>      
                                        <p>Senarai Projek</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-2">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>1</h3>      
                                        <p>Senarai Projek</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-2">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>1</h3>      
                                        <p>Senarai Projek</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>1</h3>      
                        <p>Senarai Projek</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>1</h3>      
                        <p>Senarai Kelulusan Projek</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
        </div>

        @include ('components._flashes')
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
