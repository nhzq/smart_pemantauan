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
                @hasanyrole ('ku')
                    <div class="panel panel-borderless">
                        <div class="panel-body panel-nav">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <a href="{{ route('analyses.create', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Pasukan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhasanyrole

                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Pasukan Pembekal/ Kontraktor
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered font-std">
                                    <tr class="info">
                                        <th class="col-sm-1">#</th>
                                        <th class="col-sm-5">Jawatan</th>
                                        <th class="col-sm-4">Bilangan Kakitangan</th>
                                        <th class="col-sm-2">Tindakan</th>
                                    </tr>
                                    @if (!empty($analyses))
                                        @foreach ($analyses as $data)
                                            <tr>
                                                <td>{{ $analyses->perPage() * ($analyses->currentPage() - 1) + $loop->iteration }}</td>
                                                <td>{{ $data->position ?? 'N/A' }}</td>
                                                <td>{{ $data->total ?? 'N/A' }}</td>
                                                <td>
                                                    {{ Form::open(['url' => route('analyses.destroy', [$project->id, $data->id]), 'method' => 'delete']) }}
                                                        <div class="min50">
                                                            <div class="btn-group">
                                                                <a href="{{ route('analyses.edit', [$project->id, $data->id]) }}" class="btn bg-purple">
                                                                    <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                </a>
                                                                <button class="btn btn-danger" type="submit">
                                                                    <i class="fa fa-fw fa-trash-o"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    {{ Form::close() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                            </div>

                            <div class="pull-right">
                                {{ $analyses->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
