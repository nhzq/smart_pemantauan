@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
@endpush

@section ('content')
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">Peruntukan mengikut Kategori Bajet</div>
                    <div class="panel-body">
                        @if (!empty($provision->id))
                            {{ Form::open(['url' => route('provisions.update', $provision->id), 'method' => 'PUT']) }}
                        @else
                            {{ Form::open(['url' => route('provisions.store'), 'method' => 'POST']) }}
                        @endif
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Bajet</label>
                                            <input class="form-control" type="text" value="{{ setBudgetTitle($budget->code, $budget->description, 'no-bold') }}" readonly>
                                            <input class="form-control" type="hidden" name="budget_type" value="{{ $budget->id }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Peruntukan (RM)</label>
                                            <input class="form-control money-convert" 
                                                type="text" name="budget_allocation" 
                                                placeholder="Peruntukan (RM)" 
                                                value="{{ !empty($provision->amount) ? currency($provision->amount) : '' }}">
                                        </div>
                                    </div>
                                </div>
                                
                                @if (!empty($provision))
                                    <hr>
                                        <div class="text-center"><strong>Peruntukan Tambahan</strong></div>
                                    <hr>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered" id="item_table">
                                                    <tr class="info">
                                                        <th style="vertical-align: middle;">Jenis Peruntukan</th>
                                                        <th style="vertical-align: middle;">Jumlah (RM)</th>
                                                        <th class="col-sm-1 text-center">
                                                            <button type="button" name="add" class="btn btn-diamond btn-sm add"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </th>
                                                    </tr>

                                                    @if (!empty($provision->additionals))
                                                        @foreach ($provision->additionals as $data)
                                                            <tr>
                                                                <td>
                                                                    <?php
                                                                        $types = [
                                                                            'Dasar Baru',
                                                                            'One Off'
                                                                        ];
                                                                    ?>
                                                                    <select id="provision_type" class="form-control" name="allocation_type[]">
                                                                        <option value="0">-- Sila Pilih --</option>
                                                                        @foreach ($types as $type)
                                                                            <?php 
                                                                                $selected = '';

                                                                                if ($data->extra_budget_from == $type) {
                                                                                    $selected = 'selected';
                                                                                }
                                                                            ?>
                                                                            <option value="{{ $type }}" {{ $selected }}>{{ $type }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control money-convert"
                                                                        name="additional_provision[]" 
                                                                        value="{{ currency($data->extra_budget) }}"
                                                                    />
                                                                </td>
                                                                <td class="text-center">
                                                                    <button type="button" name="remove" class="btn btn-danger btn-sm remove">
                                                                        <span class="glyphicon glyphicon-minus"></span>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-2 mrg20B mrg20T pull-right">
                                <button class="btn btn-block btn-primary" type="submit">
                                    Simpan
                                </button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@push ('script')
    <script src="{{ asset('adminlte/plugin/maskMoney/jquery.maskMoney.min.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            $('.money-convert').maskMoney();
            var max = 2;
            var x = 1;

            $(document).on('click', '.add', function () {
                if (x <= max) {
                    var html = '';

                    html += '<tr>';
                    html += '<td>';
                    html += '<select id="provision_type" class="form-control" name="allocation_type[]">';
                    html += '<option value="0">-- Sila Pilih --</option><?php echo getAdditionalBudgetList(); ?>';
                    html += '</select>';
                    html += '</td>';
                    html += '<td><input type="text" name="additional_provision[]" class="form-control money-convert" /></td>';
                    html += '<td class="text-center"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';

                    $('#item_table').append(html);
                    $('#item_table').find('.money-convert').maskMoney();

                    x++;
                }
            });

            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endpush