<!-- Home -->
@if (Route::current()->getName() == 'home')    
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
@endif
<!-- end -->

<!-- Projects -->
@if (Route::current()->getName() == 'projects.index')    
    <section class="content-header">
        <h1>
            Projek
            <small>Projek Keseluruhan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('projects.index') }}"><i class="fa fa-dashboard"></i> Projek</a></li>
            <li class="active">Projek Keseluruhan</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'projects.create')    
    <section class="content-header">
        <h1>
            Projek
            <small>Projek Baru</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('projects.index') }}"><i class="fa fa-dashboard"></i> Projek</a></li>
            <li class="active">Projek Baru</li>
        </ol>
    </section>
@endif
<!-- end -->

<!-- Allocation -->
@if (Route::current()->getName() == 'allocations.index')
    <section class="content-header">
        <h1>
            Peruntukan
            <small>Jenis Bajet</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('allocations.index') }}"><i class="fa fa-dashboard"></i> Peruntukan</a></li>
            <li class="active">Jenis Bajet</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'allocations.create')
    <section class="content-header">
        <h1>
            Peruntukan
            <small>Peruntukan Baru</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('allocations.index') }}"><i class="fa fa-dashboard"></i> Peruntukan</a></li>
            <li class="active">Peruntukan Baru</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'allocations.update')
    <section class="content-header">
        <h1>
            Peruntukan
            <small>Kemaskini Peruntukan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('allocations.index') }}"><i class="fa fa-dashboard"></i> Peruntukan</a></li>
            <li class="active">Kemaskini Peruntukan</li>
        </ol>
    </section>
@endif
<!-- End -->

<!-- User -->
@if (Route::current()->getName() == 'users.index')
    <section class="content-header">
        <h1>
            Pengguna
            <small>Keseluruhan Pengguna</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('users.index') }}"><i class="fa fa-dashboard"></i> Pengguna</a></li>
            <li class="active">Keseluruhan Pengguna</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'users.create')
    <section class="content-header">
        <h1>
            Pengguna
            <small>Pengguna Baru</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('users.index') }}"><i class="fa fa-dashboard"></i> Pengguna</a></li>
            <li class="active">Pengguna Baru</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'users.edit')
    <section class="content-header">
        <h1>
            Pengguna
            <small>Kemaskini Pengguna</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('users.index') }}"><i class="fa fa-dashboard"></i> Pengguna</a></li>
            <li class="active">Kemaskini Pengguna</li>
        </ol>
    </section>
@endif
<!-- end -->

<!-- Role -->
@if (Route::current()->getName() == 'roles.index')
    <section class="content-header">
        <h1>
            Peranan
            <small>Keseluruhan Peranan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('roles.index') }}"><i class="fa fa-dashboard"></i> Peranan</a></li>
            <li class="active">Keseluruhan Peranan</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'roles.edit')
    <section class="content-header">
        <h1>
            Peranan
            <small>Kemaskini Peranan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('roles.index') }}"><i class="fa fa-dashboard"></i> Peranan</a></li>
            <li class="active">Kemaskini Peranan</li>
        </ol>
    </section>
@endif
<!-- end -->

<!-- Section -->
@if (Route::current()->getName() == 'sections.index')
    <section class="content-header">
        <h1>
            Seksyen
            <small>Keseluruhan Seksyen</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('sections.index') }}"><i class="fa fa-dashboard"></i> Seksyen</a></li>
            <li class="active">Keseluruhan Seksyen</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'sections.edit')
    <section class="content-header">
        <h1>
            Seksyen
            <small>Kemaskini Seksyen</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('sections.index') }}"><i class="fa fa-dashboard"></i> Seksyen</a></li>
            <li class="active">Kemaskini Seksyen</li>
        </ol>
    </section>
@endif
<!-- end -->

<!-- Unit -->
@if (Route::current()->getName() == 'units.index')
    <section class="content-header">
        <h1>
            Unit
            <small>Keseluruhan Unit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('units.index') }}"><i class="fa fa-dashboard"></i> Unit</a></li>
            <li class="active">Keseluruhan Unit</li>
        </ol>
    </section>
@endif
<!-- end -->