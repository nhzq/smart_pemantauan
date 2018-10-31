<!-- Project -->
@if (Route::current()->getName() == 'projects.index')
    @if (\App\Helpers\ProjectStatus::isAppliedByKU($project->status))
        <span class="label label-default">Reviewed by KS</span>
    @endif

    @if (\App\Helpers\ProjectStatus::isApprovedByKS($project->status))
        <span class="label label-info">Reviewed by KJ</span>
    @endif

    @if (\App\Helpers\ProjectStatus::isRejectedByKS($project->status))
        <span class="label label-danger">Rejected by KS</span>
    @endif

    @if (\App\Helpers\ProjectStatus::isApprovedByKJ($project->status))
        <span class="label label-success">Approved by KJ</span>
    @endif

    @if (\App\Helpers\ProjectStatus::isRejectedByKJ($project->status))
        <span class="label label-danger">Rejected by KJ</span>
    @endif
@endif
<!-- End -->

<!-- Reviews -->
@if (Route::current()->getName() == 'reviews.index')   
    @if (\App\Helpers\ProjectStatus::isAppliedByKU($project->status))
        <span class="label label-warning">Review</span>
    @endif

    @if (\App\Helpers\ProjectStatus::isApprovedByKS($project->status))
        <span class="label label-info">Pending</span>
    @endif

    @if (\App\Helpers\ProjectStatus::isRejectedByKS($project->status))
        <span class="label label-danger">Reject</span>
    @endif

    @if (\App\Helpers\ProjectStatus::isApprovedByKJ($project->status))
        <span class="label label-success">Approved</span>
    @endif

    @if (\App\Helpers\ProjectStatus::isRejectedByKJ($project->status))
        <span class="label label-danger">Rejected</span>
    @endif
@endif
<!-- End -->