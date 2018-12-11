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
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'projects.timeline' ? 'text-red' : '' }}"></i> Semakan
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
                        <a href="{{ route('schedules.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'schedules.index' ? 'text-red' : '' }}"></i> Jadual Perancangan Projek
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gantt.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'gantt.index' ? 'text-red' : '' }}"></i> Gantt Chart
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('verifications.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'verifications.index' ? 'text-red' : '' }}"></i> Pengesahan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('planning.reviews.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'planning.reviews.index' ? 'text-red' : '' }}"></i> Semakan
                        </a>
                    </li>
                @endif

                @if (request()->is('*collection*'))
                    <li>
                        <a href="{{ route('collection.project.information', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'collection.project.information' ? 'text-red' : '' }}"></i> Maklumat Projek
                        </a>
                    </li>
                    @if (!empty($project->lookup_collection_type_id))
                        <?php $type = $project->lookup_collection_type_id; ?>
                        @if ($type == 5)
                            <li>
                                <a href="{{ route('committees.index', $project->id) }}">
                                    <i class="fa fa-circle-o {{ Route::current()->getName() == 'committees.index' ? 'text-red' : '' }}"></i> Jawatankuasa Rundingan Harga
                                </a>
                            </li>
                        @endif
                        
                        @if ($type == 2 || $type == 3 || $type == 4)
                            <li>
                                <a href="{{ route('committees.index', $project->id) }}">
                                    <i class="fa fa-circle-o {{ Route::current()->getName() == 'committees.index' ? 'text-red' : '' }}"></i> Jawatankuasa Perolehan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('methods.index', $project->id) }}">
                                    <i class="fa fa-circle-o {{ Route::current()->getName() == 'methods.index' ? 'text-red' : '' }}"></i> Kaedah Perolehan
                                </a>
                            </li>
                        @endif
                    @endif

                    <li>
                        <a href="{{ route('results.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'results.index' ? 'text-red' : '' }}"></i> Keputusan Perolehan
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-circle-o"></i> Jadual Perancangan Projek
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contractors.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'contractors.index' ? 'text-red' : '' }}"></i> Perlantikan Kontraktor
                        </a>
                    </li>
                @endif

                @if (request()->is('*development*'))
                    <li>
                        <a href="{{ route('development.project.information', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'development.project.information' ? 'text-red' : '' }}"></i> Maklumat Projek
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contracts.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'contracts.index' ? 'text-red' : '' }}"></i> Butiran Kontrak
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customers.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'customers.index' ? 'text-red' : '' }}"></i> Butiran Pelanggan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('scopes.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'scopes.index' ? 'text-red' : '' }}"></i> Skop Kontrak
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('chart.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'chart.index' ? 'text-red' : '' }}"></i> Carta Organisasi Pasukan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('meetings.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'meetings.index' ? 'text-red' : '' }}"></i> Mesyuarat
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('records.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'records.index' ? 'text-red' : '' }}"></i> Rekod-rekod disenggara
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('interims.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'interims.index' ? 'text-red' : '' }}"></i> Pembayaran Kontrak
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('bond.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'bond.index' ? 'text-red' : '' }}"></i> Bond Perlaksanaan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('eot.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'eot.index' ? 'text-red' : '' }}"></i> Lanjutan Masa (EOT)
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('lad.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'lad.index' ? 'text-red' : '' }}"></i> Bayaran Ganti Rugi (LAD)
                        </a>
                    </li>
                @endif

                @if (request()->is('*termination*'))
                    <li>
                        <a href="{{ route('deliverables.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'deliverables.index' ? 'text-red' : '' }}"></i> Serahan Projek
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('certificates.index', $project->id) }}">
                            <i class="fa fa-circle-o {{ Route::current()->getName() == 'certificates.index' ? 'text-red' : '' }}"></i> Perakuan Akaun Muktamad
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
</div>