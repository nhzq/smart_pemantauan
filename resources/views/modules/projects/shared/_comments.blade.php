<?php 
    $approvedByKS = \App\Helpers\Status::initial_approved_by_ks();
    $rejectedByKS = \App\Helpers\Status::initial_rejected_by_ks();
    $approvedBySUB = \App\Helpers\Status::initial_approved_by_sub();
    $rejectedBySUB = \App\Helpers\Status::initial_rejected_by_sub();
?>

@if (!empty($project))
    @if ($project->status == $approvedByKS)
        <?php $data = $project->reviews()->where('status', $approvedByKS)->first(); ?>

        <div class="alert alert-success">
            <p><i class="icon fa fa-ban"></i>&nbsp; Projek ini diterima oleh {{ $data->createdByUser->name }} dan sedang di nilai oleh SUB</p>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: transparent"><strong>Komen</strong></div>
            <div class="panel-body">{!! $data->content !!}</div>
        </div>
    @endif

    @if ($project->status == $rejectedByKS)
        <?php $data = $project->reviews()->where('status', $rejectedByKS)->first(); ?>
        
        <div class="alert alert-danger">
            <p><i class="icon fa fa-ban"></i>&nbsp; Projek ini ditolak oleh {{ $data->createdByUser->name }}</p>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: transparent"><strong>Komen</strong></div>
            <div class="panel-body">{!! $data->content !!}</div>
        </div>
    @endif

    @if ($project->status == $approvedBySUB)
        <?php $data = $project->reviews()->where('status', $approvedBySUB)->first(); ?>

        <div class="alert alert-success">
            <p><i class="icon fa fa-ban"></i>&nbsp; Projek ini diterima oleh {{ $data->createdByUser->name }}</p>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: transparent"><strong>Komen</strong></div>
            <div class="panel-body">{!! $data->content !!}</div>
        </div>
    @endif

    @if ($project->status == $rejectedBySUB)
        <?php $data = $project->reviews()->where('status', $rejectedBySUB)->first(); ?>
        
        <div class="alert alert-danger">
            <p><i class="icon fa fa-ban"></i>&nbsp; Projek ini ditolak oleh {{ $data->createdByUser->name }}</p>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: transparent"><strong>Komen</strong></div>
            <div class="panel-body">{!! $data->content !!}</div>
        </div>
    @endif
@endif

