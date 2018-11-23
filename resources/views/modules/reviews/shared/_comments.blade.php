@if (\Auth::user()->hasRole('ks'))
    @if (\App\Helpers\Status::isAppliedByKU($project->status))
        {{ Form::open(['method' => 'POST']) }}
            <div class="box box-solid">
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Komen</label>
                                    <textarea class="form-control" rows="5" name="review_content"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mrg10B mrg10T pull-right">
                        <div class="btn-group">
                            <button class="btn btn-primary" type="submit" formaction="{{ route('reviews.approve.ks', $project->id) }}">Terima</button>
                            <button class="btn btn-danger" type="submit" formaction="{{ route('reviews.reject.ks', $project->id) }}">Tolak</button>
                        </div>
                    </div>
                </div>
            </div>
        {{ Form::close() }}
    @endif
@endif

@if (\Auth::user()->hasRole('sub'))
    @if (\App\Helpers\Status::isApprovedByKS($project->status))
        {{ Form::open(['method' => 'POST']) }}
            <div class="box box-solid">
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Komen</label>
                                    <textarea class="form-control" rows="5" name="review_content"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mrg10B mrg10T pull-right">
                        <div class="btn-group">
                            <button class="btn btn-primary" type="submit" formaction="{{ route('reviews.approve.sub', $project->id) }}">Terima</button>
                            <button class="btn btn-danger" type="submit" formaction="{{ route('reviews.reject.sub', $project->id) }}">Tolak</button>
                        </div>
                    </div>
                </div>
            </div>
        {{ Form::close() }}
    @endif
@endif