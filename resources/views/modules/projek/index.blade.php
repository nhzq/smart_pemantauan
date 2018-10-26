@extends ('layouts.master')

@section ('content')
    <!-- Content Header (Page header) -->
    @include ('components._breadcrumbs')

    <!-- Main content -->
    <section class="content">
        @include ('components._flashes')
    </section>
    <!-- /.content -->
@endsection
