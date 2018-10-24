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

<!-- User -->
@if (Route::current()->getName() == 'users.index')
    <section class="content-header">
        <h1>
            Users
            <small>All Users</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('users.index') }}"><i class="fa fa-dashboard"></i> Users</a></li>
            <li class="active">All Users</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'users.create')
    <section class="content-header">
        <h1>
            Users
            <small>Create New User</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('users.index') }}"><i class="fa fa-dashboard"></i> Users</a></li>
            <li class="active">Create New User</li>
        </ol>
    </section>
@endif
<!-- end -->

<!-- Roles -->
@if (Route::current()->getName() == 'roles.index')
    <section class="content-header">
        <h1>
            Roles
            <small>All Roles with Permissions</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('roles.index') }}"><i class="fa fa-dashboard"></i> Roles</a></li>
            <li class="active">All Roles with Permissions</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'roles.create')
    <section class="content-header">
        <h1>
            Roles
            <small>Create roles with permission</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('roles.index') }}"><i class="fa fa-dashboard"></i> Roles</a></li>
            <li class="active">Create Role with Permissions</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'roles.edit')
    <section class="content-header">
        <h1>
            Roles
            <small>Edit role with permissions</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('roles.index') }}"><i class="fa fa-dashboard"></i> Roles</a></li>
            <li class="active">Edit Role with Permissions</li>
        </ol>
    </section>
@endif
<!-- end -->