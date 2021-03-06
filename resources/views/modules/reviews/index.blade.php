@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
@endpush

@section ('content')
    <!-- Content Header (Page header) -->
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        @include ('components._phases')

        <div class="row">
            @include ('components._menu')

            <div class="col-md-9">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Sokongan Projek
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            @if (\App\Helpers\Status::project_verification($project->status))
                                @hasanyrole ('ks')
                                    {{ Form::open(['method' => 'POST']) }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Komen</label>
                                                    <textarea class="form-control" rows="5" name="review_comment"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mrg10B mrg10T pull-right">
                                                    <div class="btn-group">
                                                        <button class="btn btn-primary" type="submit" formaction="{{ route('planning.reviews.approve.ks', $project->id) }}">Terima Perancangan Projek</button>
                                                        <button class="btn btn-warning" type="submit" formaction="{{ route('planning.reviews.approve.ks', $project->id) }}">Terima Perlu Pindaan</button>
                                                        <button class="btn btn-danger" type="submit" formaction="{{ route('planning.reviews.reject.ks', $project->id) }}">Tolak Perancangan Projek</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                @endhasanyrole
                            @endif
                            
                            @if (\App\Helpers\Status::planning_approved_by_ks($project->status) || \App\Helpers\Status::planning_rejected_by_ks($project->status))
                                @hasanyrole ('ku|ks')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                        <tr class="info">
                                                            <th></th>
                                                            <th>Maklumat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th class="col-md-3 min100">Status</th>
                                                            <td>
                                                                @include ('components._status')
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="col-md-3 min100">Komen</th>
                                                            {{-- @foreach ($project->reviews as $data) --}}
                                                            @if (!empty($project->reviews->last()->status))
                                                                @if (\App\Helpers\Status::planning_approved_by_ks($project->reviews->last()->status))
                                                                    <td>{{ $project->reviews->last()->content }}</td>
                                                                @endif

                                                                @if (\App\Helpers\Status::planning_rejected_by_ks($project->reviews->last()->status))
                                                                    <td>{{ $project->reviews->last()->content }}</td>
                                                                @endif
                                                            @endif
                                                            {{-- @endforeach --}}
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endhasanyrole
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
