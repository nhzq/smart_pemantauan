<?php 
    $approvedBySUB = \App\Helpers\Status::isApprovedBySUB();
    $rejectedByKS = \App\Helpers\Status::isRejectedByKS();
    $rejectedBySUB = \App\Helpers\Status::isRejectedBySUB();
?>

@if ($project->status == $approvedBySUB || $project->status == $rejectedByKS || $project->status == $rejectedBySUB)
    <ul class="timeline">
        @foreach ($project->reviews()->orderBy('id', 'desc')->get() as $review)
            <?php $user = \App\Models\User::where('id', $review->created_by)->first(); ?>

            @if ($review->status == $approvedBySUB)
                <li>
                    <i class="fa fa-check bg-green"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($review->created_at)->toFormattedDateString() ?? '' }}</span>
                        <h3 class="timeline-header"><a href="#">Projek diterima oleh {{ $user->name ?? '' }}</a></h3>
                        
                        @if (!empty($review->content))
                            <div class="timeline-body">
                                <strong>Komen: </strong> <br/>
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
                        <span class="time">
                            <i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($review->created_at)->toFormattedDateString() }}
                        </span>  
                        <h3 class="timeline-header">
                            Projek telah ditolak oleh <a href="#">{{ $user->name ?? '' }}</a>
                        </h3>
                        
                        @if (!empty($review->content))
                            <div class="timeline-body">
                                <strong>Komen: </strong> <br/>
                                {{ $review->content }}
                            </div>
                        @endif
                    </div>
                </li>
            @endif

            @if ($review->status == $rejectedBySUB)
                <li>
                    <i class="fa fa-close bg-red"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($review->created_at)->toFormattedDateString() }}</span> 
                        <h3 class="timeline-header">Projek telah ditolak oleh <a href="#">{{ $user->name ?? '' }}</a></h3>
                        
                        @if (!empty($review->content))
                            <div class="timeline-body">
                                <strong>Komen: </strong> <br/>
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