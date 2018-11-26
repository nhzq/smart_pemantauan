@if (Route::current()->getName() == 'projects.index' || Route::current()->getName() == 'projects.show')
    <?php 
        isset($data) ? $data : '';
        isset($project) ? $data = $project : '';
    ?>

    @if (\App\Helpers\Status::isAppliedByKU($data->status))
        @if (\Auth::user()->hasRole('ks'))
            <span class="label label-warning">Perlu Semakan</span>
        @endif

        @if (\Auth::user()->hasRole('ku'))
            <span class="label label-default">Dalam Semakan KS</span>
        @endif
    @endif

    @if (\App\Helpers\Status::isApprovedByKS($data->status))
        @if (\Auth::user()->hasAnyRole('ks|ku'))
            <span class="label label-info">Dalam Semakan SUB</span>
        @endif

        @if (\Auth::user()->hasRole('sub'))
            <span class="label label-warning">Perlu Semakan</span>
        @endif
    @endif

    @if (\App\Helpers\Status::isRejectedByKS($data->status))
        @if (\Auth::user()->hasRole('ks'))
            <span class="label label-danger">Telah Ditolak</span>
        @endif

        @if (\Auth::user()->hasRole('ku'))
            <span class="label label-danger">Ditolak KS</span>
        @endif
    @endif

    @if (\App\Helpers\Status::isApprovedBySUB($data->status))
        <span class="label label-success">Diterima SUB</span>
    @endif

    @if (\App\Helpers\Status::isRejectedBySUB($data->status))
        <span class="label label-danger">Ditolak SUB</span>
    @endif

    @if (\App\Helpers\Status::planningByKU($data->status))
        @if (\Auth::user()->hasRole('ks'))
            <span class="label label-warning">Perlu Semakan</span>
        @endif
    @endif
@endif

@if (Route::current()->getName() == 'planning.reviews.index')
    @if (\App\Helpers\Status::planningApprovedByKS($project->status))
        <span class="label label-success">Projek Diterima KS</span>
    @endif

    @if (\App\Helpers\Status::planningRejectedByKS($project->status))
        <span class="label label-danger">Projek Ditolak KS</span>
    @endif
@endif