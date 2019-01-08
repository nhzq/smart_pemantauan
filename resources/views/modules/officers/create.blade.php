@extends ('layouts.master')

@push ('css')
@endpush

@section ('content')
    @include ('components._breadcrumbs')
    
    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')
        
        <div class="row mrg10T">
            <div class="col-md-12">
                <div class="panel panel-borderless">
                    <div class="panel-heading panel-dark">
                        Pengguna Baru
                    </div>

                    <div class="panel-body">
                        <div class="mrg10T mrg10B">
                            {{ Form::open(['url' => route('officers.store'), 'method' => 'POST']) }}
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input class="form-control" type="text" name="user_name" placeholder="Nama">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No K/P</label>
                                                <input class="form-control" type="text" name="user_ic" placeholder="No K/P">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Peranan</label>
                                                <select class="form-control select2" name="user_role">
                                                    <option value="0">-- Sila Pilih --</option>
                                                    @if (!empty($roles))
                                                        @foreach ($roles as $data)
                                                            <option value="{{ $data->id }}">{{ $data->displayed_name ?? '' }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Projek</label>
                                                <select class="form-control select2" name="user_project">
                                                    <option value="0">-- Sila Pilih --</option>
                                                    @if (!empty($projects))
                                                        @foreach ($projects as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mrg10T">
                                            <small><i>p/s: User's default password would be <strong>password</strong></i></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 mrg20T pull-right">
                                    <button class="btn btn-block btn-primary" type="submit">
                                        Simpan
                                    </button>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push ('script')
    <script>
        $(function () {
            $('.select2').select2();
        });
    </script>
@endpush