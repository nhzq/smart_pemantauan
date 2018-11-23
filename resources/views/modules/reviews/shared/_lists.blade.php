@if (\Auth::user()->hasRole('sub'))
    @if (App\Helpers\Status::isApprovedByKS($data->status) || App\Helpers\Status::isApprovedBySUB($data->status) || App\Helpers\Status::isRejectedBySUB($data->status))
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
    <tr>
        <td>{{ $projects->perPage() * ($projects->currentPage() - 1) + $loop->iteration }}</td>
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
                        <a href="" class="btn bg-purple">
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