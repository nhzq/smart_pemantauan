@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
@endpush

@section ('content')
    <!-- Content Header (Page header) -->
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')
        
        <div class="row mrg10T">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title"><strong>{{ $project->name ?? 'N/A' }}</strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th class="col-md-3 min100">&nbsp;</th>
                                    <th>Details</th>
                                </tr>
                                <tr>
                                    <th class="col-md-3 min100">Project</th>
                                    <td>{{ $project->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-3 min100">Cost</th>
                                    <td>RM {{ helperCurrency($project->cost) ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-3 min100">Description</th>
                                    <td>{{ $project->description ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php 
            $approvedByKJ = \App\Helpers\ProjectStatus::isApprovedByKJ();
            $rejectedByKS = \App\Helpers\ProjectStatus::isRejectedByKS();
            $rejectedByKJ = \App\Helpers\ProjectStatus::isRejectedByKJ();
        ?>
        @if ($project->status == $approvedByKJ || $project->status == $rejectedByKS || $project->status == $rejectedByKJ)
            <ul class="timeline">
                @foreach ($project->reviews()->orderBy('id', 'desc')->get() as $review)
                    @if ($review->status == $approvedByKJ)
                        <li>
                            <i class="fa fa-check bg-green"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::now() }}</span>
                                
                                <h3 class="timeline-header"><a href="#">{{ 'Name' }}</a> has approved your project</h3>
                                
                                @if (!empty($review->content))
                                    <div class="timeline-body">
                                        <strong>Comment: </strong> <br/>
                                        {{ $review->content }}
                                    </div>
                                @endif
                            </div>
                        </li>
                    @endif

                    @if ($review->status == $rejectedByKS)
                        <li>
                            <i class="fa fa-close bg-red"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::now() }}</span>
                                
                                <h3 class="timeline-header"><a href="#">{{ 'Name' }}</a> has rejected your project</h3>
                                
                                @if (!empty($review->content))
                                    <div class="timeline-body">
                                        <strong>Comment: </strong> <br/>
                                        {{ $review->content }}
                                    </div>
                                @endif
                            </div>
                        </li>
                    @endif

                    @if ($review->status == $rejectedByKJ)
                        <li>
                            <i class="fa fa-close bg-red"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::now() }}</span>
                                
                                <h3 class="timeline-header"><a href="#">{{ 'Name' }}</a> has rejected your project</h3>
                                
                                @if (!empty($review->content))
                                    <div class="timeline-body">
                                        <strong>Comment: </strong> <br/>
                                        {{ $review->content }}
                                    </div>
                                @endif
                            </div>
                        </li>
                    @endif
                @endforeach
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        @endif
    </section>
@endsection
