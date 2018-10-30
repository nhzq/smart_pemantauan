@extends ('layouts.master')

@section ('content')
    <!-- Content Header (Page header) -->
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        @if (count(\App\Models\Project::all()) > 0)
                            <h3>RM {{ helperCurrency(\App\Models\Project::orderBy('id', 'DESC')->pluck('total_amount')->first()) }}</h3>
                        @else
                            <h3>RM 0.00</h3>         
                        @endif

                        <p>Total Budget</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        @if (count(\App\Models\Project::all()) > 0)
                            <h3>RM {{ helperCurrency(\App\Models\Project::orderBy('id', 'DESC')->pluck('total_amount')->first() / count(\App\Models\Project::all()))}}</h3>
                        @else
                            <h3>RM 0.00</h3>         
                        @endif

                        <p>Average Cost Per Project</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            {{-- <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>44</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div> --}}
            <!-- ./col -->
        {{--     <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div> --}}
            <!-- ./col -->
        </div>

        @include ('components._flashes')
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
