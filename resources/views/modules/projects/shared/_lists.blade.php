@if (\Auth::user()->hasRole('sub'))
    <?php 
        $isApprovedByKS = App\Helpers\Status::isApprovedByKS($data->status);
        $isApprovedBySUB = App\Helpers\Status::isApprovedBySUB($data->status);
        $isRejectedBySUB = App\Helpers\Status::isRejectedBySUB($data->status);
    ?>
    
    @if ( $isApprovedByKS || $isApprovedBySUB || $isRejectedBySUB)
        <tr>
            <td>{{ $projects->perPage() * ($projects->currentPage() - 1) + $loop->iteration }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ currency($data->estimate_cost) }}</td>
            <td> @include ('components._status') </td>
            <td>
                <div class="min130">
                    <div class="btn-group">
                        <a href="{{ route('reviews.show', $data->id) }}" class="btn bg-purple">
                            <i class="fa fa-fw fa-folder-open-o"></i>
                        </a>
                    </div>
                </div>
            </td>
        </tr>
    @endif
@endif

@if (\Auth::user()->hasAnyRole('ku|ks'))
    <?php
        $total_sub_budget = \App\Models\Project::where('lookup_sub_budget_type_id', $data->lookup_sub_budget_type_id)->sum('estimate_cost');
    ?>

    <tr>
        <td>{!! setBudgetTitle($data->budget->code, $data->sub->description) !!}</td>
        <td>{{ currency($total_sub_budget) }}</td>
        <td class="tbl-default">{{ $projects->perPage() * ($projects->currentPage() - 1) + $loop->iteration }}</td>
        <td>{{ $data->name }}</td>
        <td>{{ currency($data->estimate_cost) }}</td>
        <td> @include ('components._status') </td>
        <td>
            <div class="min130">
                <div class="btn-group">
                    @if (\Auth::user()->hasRole('ku'))
                        <a href="{{ route('projects.show', $data->id) }}" class="btn bg-purple">
                            <i class="fa fa-fw fa-folder-open-o"></i>
                        </a>
                        <a href="{{ route('projects.edit', $data->id) }}" class="btn bg-purple">
                            <i class="fa fa-fw fa-pencil-square-o"></i>
                        </a>
                        <button class="btn btn-danger" type="submit">
                            <i class="fa fa-fw fa-trash-o"></i>
                        </button>
                    @endif

                    @if (\Auth::user()->hasRole('ks'))
                        <a href="{{ route('reviews.show', $data->id) }}" class="btn bg-purple">
                            <i class="fa fa-fw fa-folder-open-o"></i>
                        </a>
                    @endif
                </div>
            </div>
        </td>
    </tr>
@endif