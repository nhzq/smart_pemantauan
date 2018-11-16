@extends ('layouts.master')

@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/width.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/spacing.css') }}">

@endpush

@section ('content')
    @include ('components._breadcrumbs')
    
    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')
        
        <div class="row mrg10T">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border panel-header-border-blue">
                        <h3 class="box-title">Create User</h3>
                    </div>

                    <div class="box-body">
                        <div class="mrg10T mrg10B">
                            {{ Form::open(['url' => route('users.store'), 'method' => 'POST']) }}
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('user_name') ? 'has-error' : '' }}">
                                                <label>Name</label>
                                                <input class="form-control" type="text" name="user_name" placeholder="Name">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('user_ic') ? 'has-error' : '' }}">
                                                <label>IC Number</label>
                                                <input class="form-control" type="text" name="user_ic" placeholder="IC Number">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('user_department') ? 'has-error' : '' }}">
                                                <label>Department</label>
                                                <select class="form-control" name="user_department">
                                                    <option value="0">-- Please choose --</option>
                                                    @if (!empty($departments))
                                                        @foreach ($departments as $department)
                                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('user_role') ? 'has-error' : '' }}">
                                                <label>Role</label>
                                                <select id="user_role" class="form-control" name="user_role">
                                                    <option value="0">-- Please choose --</option>
                                                    @if (!empty($roles))
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->displayed_name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div id="section"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mrg10T">
                                            <small><i>p/s: User's default password would be <strong>password</strong></i></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 mrg20B mrg20T pull-right">
                                    <button class="btn btn-block btn-primary" type="submit">
                                        Save
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
    <script type="text/javascript">
        $(function () {
            $('#user_role').on('change', function () {
                var selected_value = $(this).val();
                var section = ' ';
                
                /* For Unit Name */
                if (selected_value == 2) {
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '{{ route('users.create.unit') }}',
                        data: {
                            'id': selected_value
                        },
                        success: function (data) {
                            section += '<div class="form-group">';
                            section += '<label>Units Name</label>';
                            section += '<select class="form-control" name="user_unit">';
                            section += '<option value="0">-- Please choose --</option>';

                            for(var i = 0; i < data.length; i++) {
                                section += '<option value="' + data[i].id + '">' + data[i].displayed_name + '</option>';
                            }

                            section += '</select>';
                            section += '</div>';

                            if (data.length > 0) {
                                $('#section').html(" ");
                                $('#section').append(section);
                            }
                        },
                        error: function (xhr, desc, err) {
                            console.log('error');
                        }
                    });
                } 

                /* For Section Name */
                if (selected_value == 3) {
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url: '{{ route('users.create.section') }}',
                        data: {
                            'id': selected_value
                        },
                        success: function (data) {
                            section += '<div class="form-group">';
                            section += '<label>Sections Name</label>';
                            section += '<select class="form-control" name="user_section">';
                            section += '<option value="0">-- Please choose --</option>';

                            for(var i = 0; i < data.length; i++) {
                                section += '<option value="' + data[i].id + '">' + data[i].displayed_name + '</option>';
                            }

                            section += '</select>';
                            section += '</div>';

                            if (data.length > 0) {
                                $('#section').html(" ");
                                $('#section').append(section);
                            }
                        },
                        error: function (xhr, desc, err) {
                            console.log('error');
                        }
                    });
                }

                $('#section').empty();
            });
        });
    </script>
@endpush