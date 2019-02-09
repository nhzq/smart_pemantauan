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
                                            <a href="{{ route('interims.create', $project->id) }}" class="btn btn-diamond">
                                                <i class="fa fa-fw fa-plus"></i> Pembayaran Kontrak
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhasanyrole
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-borderless">
                            <div class="panel-heading panel-dark">
                                Pembayaran Kontrak
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered font-std">
                                        <tr class="info">
                                            <th class="text-center" colspan="2">Nama Projek</th>
                                            <th class="text-center">Anggaran Kos (RM)</th>
                                            <th class="text-center">Kos Sebenar (RM)</th>
                                            <th class="text-center">Jumlah Belanja (RM)</th>
                                            <th class="text-center">Baki Belanja (RM)</th>
                                            <th class="text-center">Status Projek</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td class="text-center" colspan="2">{{ $project->name }}</td>
                                            <td class="text-right">{{ !empty($project->estimate_cost) ? currency($project->estimate_cost) : '0.00' }}</td>
                                            <td class="text-right">{{ !empty($project->actual_project_cost) ? currency($project->actual_project_cost) : '0.00' }}</td>
                                            {{-- <td>{{ !empty($project->contract->cost) ? currency($project->contract->cost) : '0.00' }}</td> --}}

                                            <?php 
                                                $spending = '0.00';
                                                $balance = '0.00';

                                                if (!empty($project->interims->sum('amount'))) {
                                                    $spending = currency($project->interims->sum('amount'));

                                                    if (!empty($project->actual_project_cost)) {
                                                        $balance = currency($project->actual_project_cost - $project->interims->sum('amount'));
                                                    }
                                                }
                                            ?>
                                            <td class="text-right">{{ $spending }}</td>
                                            <td class="text-right">{{ $balance }}</td>
                                            <td class="text-center" colspan="2"></td>
                                        </tr>
                                    </table>
                                    
                                    <hr>

                                    <table class="table table-hover table-bordered font-std">
                                        <tr class="info">
                                            <th class="text-center">#</th>
                                            <th class="text-center">Jenis Bayaran</th>
                                            <th class="text-center">No. Waran/Voucher/EFT/CEK</th>
                                            <th class="text-center">Tarikh Bayaran</th>
                                            <th class="text-center">Jumlah Bayaran (RM)</th>
                                            <th class="text-center">Tujuan Bayaran</th>
                                            <th class="text-center">Peratus Bayaran</th>
                                            <th></th>
                                        </tr>
                                        @if (!empty($project->interims))
                                            @foreach ($project->interims as $data)
                                                <tr>
                                                    <td class="align-center">{{ $loop->iteration }}</td>
                                                    <td class="align-center">{{ ucwords($data->payment_type) ?? '' }}</td>
                                                    <td class="align-center">{{ $data->payment_no ?? '' }}</td>

                                                    <?php 
                                                        $payment_date = '';
                                                        $amount = '0.00';

                                                        if (!empty($data->payment_date)) {
                                                            $payment_date = $data->payment_date->format('d/m/Y');
                                                        }

                                                        if (!empty($data->amount)) {
                                                            $amount = currency($data->amount);
                                                        }
                                                    ?>
                                                    <td class="align-center">{{ $payment_date }}</td>
                                                    <td class="text-right align-center">{{ $amount }}</td>
                                                    <td class="align-center">{{ $data->description ?? '' }}</td>

                                                    <?php 
                                                        $result = '0';
                                                        $total_cost = $project->actual_project_cost;

                                                        if (!empty($total_cost) && !empty($data->amount)) {
                                                            $result = ($data->amount/$total_cost) * 100;
                                                        }

                                                    ?>
                                                    <td class="align-center">{{ number_format($result, 2, '.', '') . '%' }}</td>
                                                    <td class="text-center align-center">
                                                        @if (empty($data->status))
                                                            <div class="btn-group-vertical">
                                                                <a href="{{ route('interims.edit', [$project->id, $data->id]) }}" class="btn btn-sm bg-purple">
                                                                    <i class="fa fa-fw fa-pencil-square-o"></i>
                                                                </a>
                                                                <a href="{{ route('interims.notify', [$project->id, $data->id]) }}" class="btn btn-sm bg-purple">
                                                                    <i class="fa fa-paper-plane"></i>
                                                                </a>
                                                            </div>
                                                        @elseif ($data->status == 2)
                                                            <i class="fa fa-check clr-diamond"></i>
                                                        @else
                                                            <i class="fa fa-clock-o clr-diamond"></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </table>

                                    <hr>
                                    
                                    <?php 
                                        $upload_files = [
                                            'Surat Perjanjian', 'Senarai Semak', 'Kertas Cadangan'
                                        ];

                                        $i = 1;
                                    ?>
                                    <table class="table table-hover table-bordered font-std">
                                        <tr class="info">
                                            <th class="col-sm-1 text-center">#</th>
                                            <th class="col-sm-2">Jenis</th>
                                            <th class="col-sm-8">Fail</th>
                                            <th class="col-sm-1 min100">&nbsp;</th>
                                        </tr>

                                        @foreach ($upload_files as $key => $data)
                                            <tr>
                                                <td class="text-center align-center">{{ $i }}</td>
                                                <td class="align-center">{{ $data }}</td>

                                                @if (!empty($project->interim_docs))
                                                    <td>
                                                        @foreach ($project->interim_docs as $doc)
                                                            @if ($doc->category == strtolower(str_replace(' ', '-', $data)))
                                                                <a href="{{ url('storage/projects/' . $project->id . '/interims/' . $doc->file_name) }}">
                                                                    <small class="label bg-maroon"><i class="fa fa-download"></i></small> &nbsp;
                                                                    {{ $doc->original_name ?? '' }}
                                                                </a>
                                                                <br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endif

                                                <td class="align-center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm bg-purple" data-toggle="modal" data-target="#modal-default-{{ $key }}">
                                                            <i class="fa fa-fw fa-plus"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-update-{{ $key }}">
                                                            <i class="fa fa-fw fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="modal-default-{{ $key }}">
                                                <div class="modal-dialog">
                                                    {{ Form::open([
                                                        'url' => route('interims.upload', $project->id), 
                                                        'method' => 'POST', 
                                                        'enctype' => 'multipart/form-data']) 
                                                    }}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Muat Naik Dokumen {{ $data }}</h4>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Minit Mesyuarat</label>
                                                                    <input type="file" name="upload_files[]" class="form-control" multiple>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="file_type" value="{{ $data }}">

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </div>
                                                    {{ Form::close() }}
                                                    <!-- /.modal-content -->
                                                </div>
                                            </div>

                                            <div class="modal fade" id="modal-update-{{ $key }}">
                                                <div class="modal-dialog">
                                                    {{ Form::open([
                                                        'url' => route('interims.delete', $project->id), 
                                                        'method' => 'POST',
                                                    ]) 
                                                    }}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Kemaskini Dokumen {{ $data }}</h4>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Senarai Dokumen {{ $data }}</label>
                                                                    <br>
                                                                    @if (!empty($project->interim_docs))
                                                                        @foreach ($project->interim_docs as $doc)
                                                                            @if ($doc->category == strtolower(str_replace(' ', '-', $data)))
                                                                                <input type="checkbox" name="file_list[]" value="{{ $doc->id ?? '' }}">
                                                                                    &nbsp; &nbsp; {{ $doc->original_name ?? '' }}
                                                                                <br>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </div>
                                                    {{ Form::close() }}
                                                    <!-- /.modal-content -->
                                                </div>
                                            </div>

                                            <?php $i++; ?>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push ('script')
@endpush
