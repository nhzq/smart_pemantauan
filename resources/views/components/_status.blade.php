@if (Route::current()->getName() == 'projects.index' || Route::current()->getName() == 'projects.show')
    <?php 
        isset($data) ? $data : '';
        isset($project) ? $data = $project : '';
    ?>

    @if (\App\Helpers\Status::project_application($data->status))
        @if (\Auth::user()->hasRole('ks'))
            <span class="label label-warning">Perlu Semakan</span>
        @endif

        @if (\Auth::user()->hasRole('ku'))
            <span class="label label-default">Dalam Semakan KS</span>
        @endif
    @endif

    @if (\App\Helpers\Status::initial_approved_by_ks($data->status))
        @if (\Auth::user()->hasAnyRole('ks|ku'))
            <span class="label label-info">Dalam Semakan SUB</span>
        @endif

        @if (\Auth::user()->hasRole('sub'))
            <span class="label label-warning">Perlu Semakan</span>
        @endif
    @endif

    @if (\App\Helpers\Status::initial_rejected_by_ks($data->status))
        @if (\Auth::user()->hasRole('ks'))
            <span class="label label-danger">Telah Ditolak</span>
        @endif

        @if (\Auth::user()->hasRole('ku'))
            <span class="label label-danger">Ditolak KS</span>
        @endif
    @endif

    @if (\App\Helpers\Status::initial_approved_by_sub($data->status))
        <span class="label label-success">Diterima SUB</span>
    @endif

    @if (\App\Helpers\Status::initial_rejected_by_sub($data->status))
        <span class="label label-danger">Ditolak SUB</span>
    @endif

    @if (\App\Helpers\Status::project_verification($data->status))
        @if (\Auth::user()->hasRole('ks'))
            <span class="label label-warning">Perlu Semakan</span>
        @endif
    @endif

    {{-- @if (\App\Helpers\Status::planning_approved_by_ks($data->status))
        @if (\Auth::user()->hasRole('ku'))
            <span class="label label-success">Projek Diterima KS</span>
        @endif
    @endif

    @if (\App\Helpers\Status::planning_rejected_by_ks($data->status))
        @if (\Auth::user()->hasRole('ku'))
            <span class="label label-danger">Projek Ditolak KS</span>
        @endif
    @endif --}}
@endif

@if (Route::current()->getName() == 'planning.reviews.index')
    @if (\App\Helpers\Status::planning_approved_by_ks($project->status))
        <span class="label label-success">Projek Diterima KS</span>
    @endif

    @if (\App\Helpers\Status::planning_rejected_by_ks($project->status))
        <span class="label label-danger">Projek Ditolak KS</span>
    @endif
@endif