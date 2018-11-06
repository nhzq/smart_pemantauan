@hasanyrole ('ketua-seksyen')    
    @if (\App\Helpers\ProjectStatus::isAppliedByKU($project->status))    
        {{ Form::open(['method' => 'POST']) }}
            <div class="box box-solid">
                <div class="box-body">
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea class="form-control" name="review_content" id="review_content" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="mrg10B pull-right">
                <div class="btn-group">
                    <button class="btn btn-primary" type="submit" formaction="{{ route('reviews.approve.ks', $project->id) }}">Approve</button>
                    <button class="btn btn-danger" type="submit" formaction="{{ route('reviews.reject.ks', $project->id) }}">Reject</button>
                </div>
            </div>
        {{ Form::close() }}
    @endif
@endhasanyrole

@hasanyrole ('ketua-jabatan-bahagian-teknologi-maklumat')
    @if (\App\Helpers\ProjectStatus::isApprovedByKS($project->status))    
        {{ Form::open(['method' => 'POST']) }}
            <div class="box box-solid">
                <div class="box-body">
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea class="form-control" name="review_content" id="review_content" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="mrg10B pull-right">
                <div class="btn-group">
                    <button class="btn btn-primary" type="submit" formaction="{{ route('reviews.approve.kj', $project->id) }}">Approve</button>
                    <button class="btn btn-danger" type="submit" formaction="{{ route('reviews.reject.kj', $project->id) }}">Reject</button>
                </div>
            </div>
        {{ Form::close() }}
    @endif
@endhasanyrole