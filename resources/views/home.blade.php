@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/nhzq.css') }}">
@endpush

@section ('content')
    <!-- Content Header (Page header) -->
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Peruntukan Setiap Unit
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered font-std">
                                <tr>
                                    <th colspan="4">B01</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Objek Sebagai</th>
                                    <th class="text-center">Jumlah (RM)</th>
                                    <th class="text-center">Baki (RM)</th>
                                    <th class="text-center">Peratus</th>
                                </tr>
                                @if (!empty($allocations))
                                    @foreach ($allocations as $allocation)
                                        <?php 
                                            $estimate_cost = 0;
                                            $net = 0;
                                            $percent = 0;

                                            if (!empty($allocation->projects()->sum('estimate_cost'))) {
                                                $estimate_cost = $allocation->projects()->sum('estimate_cost');

                                                $net = $allocation->amount - $estimate_cost;
                                            }

                                            if (!empty($allocation->amount)) {
                                                if ($estimate_cost !== 0) {
                                                    $percent = $estimate_cost / $allocation->amount * 100;
                                                }
                                            }
                                        ?>
                                        <tr>
                                            <td>{{ !empty($allocation->sub) ? $allocation->sub->description : '' }}</td>
                                            <th class="text-right">{{ currency($allocation->amount) }}</th>
                                            <th class="text-right">{{ currency($net) }}</th>
                                            <th class="text-center">{{ $percent . '%'  }}</th>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Notifikasi
                    </div>
                    <div class="panel-body"
                        style="
                            max-height: 230px;
                            overflow-y: auto;
                        "
                    >
                    
                        <ul class="list-group">
                            @if (!empty($lists = $projects->whereIn('status', [1, 8])->get()))
                                <li class="list-group-item">
                                    {{ count($lists) . ' projek perlu semakan.' }}
                                    <div class="pull-right">
                                        <a href="{{ route('projects.index') }}" class="clr-honey">
                                            <i class="fa fa-fw fa-paper-plane"></i>
                                        </a>
                                    </div>
                                </li>
                            @endif
                        </ul> 
                    </div>
                </div>
            </div>
        </div>

        @include ('components._flashes')
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
