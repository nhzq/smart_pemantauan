@hasanyrole ('ketua-seksyen')
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border panel-header-border-blue">
                <h3 class="box-title">List of Projects | <small>Reviewed by KS</small></h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="max20">#</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($projects) > 0)
                                @foreach ($projects as $project)
                                    <tr>
                                        <th class="col-md-1">{{ $projects->perPage() * ($projects->currentPage() - 1) + $loop->iteration }}</th>
                                        <td class="col-md-5 min200">{{ $project->name ?? 'N/A' }}</td>
                                        <td class="col-md-3">{{ 'RM ' . helperCurrency($project->cost) ?? 'N/A' }}</td>
                                        <td class="col-md-2">
                                            @include ('components._status')
                                        </td>
                                        <td class="col-md-1">
                                            <div class="min90">
                                                <div class="btn-group">
                                                    <a href="{{ route('reviews.show', $project->id) }}" class="btn bg-purple">
                                                        <i class="fa fa-fw fa-folder-open-o"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <th colspan="2">Jumlah</th>
                                    <td>
                                        <strong>{{ 'RM ' . helperCurrency(end($projects->toArray()['data'])['total_amount']) ?? 'N/A' }}</strong>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>No records found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <div class="pull-right">        
                    {{ $projects->links() }}                
                </div>
            </div>
        </div>
    </div>
@endhasanyrole

@hasanyrole ('ketua-jabatan-bahagian-teknologi-maklumat')
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border panel-header-border-blue">
                <h3 class="box-title">List of Projects | <small>Reviewed by KJ</small></h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="max20">#</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($projectsKS) > 0)
                                @foreach ($projectsKS as $project)
                                    <tr>
                                        <th class="col-md-1">{{ $projectsKS->perPage() * ($projectsKS->currentPage() - 1) + $loop->iteration }}</th>
                                        <td class="col-md-5 min200">{{ $project->name ?? 'N/A' }}</td>
                                        <td class="col-md-3">{{ 'RM ' . helperCurrency($project->cost) ?? 'N/A' }}</td>
                                        <td class="col-md-2">
                                            @if (\App\Helpers\ProjectStatus::isApprovedByKS($project->status))
                                                <span class="label label-warning">Review</span>
                                            @endif
                                            @if (\App\Helpers\ProjectStatus::isRejectedByKJ($project->status))
                                                <span class="label label-danger">Reject</span>
                                            @endif
                                            @if (\App\Helpers\ProjectStatus::isApprovedByKJ($project->status))
                                                <span class="label label-success">Approve</span>
                                            @endif
                                        </td>
                                        <td class="col-md-1">
                                            <div class="min90">
                                                <div class="btn-group">
                                                    <a href="{{ route('reviews.show', $project->id) }}" class="btn bg-purple">
                                                        <i class="fa fa-fw fa-folder-open-o"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>No records found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <div class="pull-right">        
                    {{ $projects->links() }}                
                </div>
            </div>
        </div>
    </div>
@endhasanyrole