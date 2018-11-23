<div class="col-md-3">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Menu</h3>

            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                @if (request()->is('*projects*'))
                    <li>
                        <a href="{{ route('projects.show', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'projects.show' ? 'text-red' : '' }}"></i> Maklumat Asas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('projects.timeline', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'projects.timeline' ? 'text-red' : '' }}"></i> Timeline
                        </a>
                    </li>
                @endif

                @if (request()->is('*reviews*'))
                    <li>
                        <a href="{{ route('reviews.show', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'reviews.show' ? 'text-red' : '' }}"></i> Maklumat Asas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('projects.timeline', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'reviews.timeline' ? 'text-red' : '' }}"></i> Timeline
                        </a>
                    </li>
                @endif

                @if (request()->is('planning*'))
                    <li>
                        <a href="{{ route('info.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'info.index' ? 'text-red' : '' }}"></i> Maklumat Projek
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('analyses.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'analyses.index' ? 'text-red' : '' }}"></i> Analisa Sumber
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('project-team.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'project-team.index' ? 'text-red' : '' }}"></i> Pasukan Projek
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-circle-o"></i> Jadual Perancangan Projek
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-circle-o"></i> Gantt Chart
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('verifications.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'verifications.index' ? 'text-red' : '' }}"></i> Pengesahan
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>