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
            Projects
            <small>All Projects</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('projects.index') }}"><i class="fa fa-dashboard"></i> Projects</a></li>
            <li class="active">All Projects</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'projects.create')    
    <section class="content-header">
        <h1>
            Projects
            <small>Create Project</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('projects.index') }}"><i class="fa fa-dashboard"></i> Projects</a></li>
            <li class="active">Create Project</li>
        </ol>
    </section>
@endif
<!-- end -->

<!-- Reviews -->
@if (Route::current()->getName() == 'reviews.index')    
    <section class="content-header">
        <h1>
            Reviews
            <small>All Projects</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('reviews.index') }}"><i class="fa fa-dashboard"></i> Reviews</a></li>
            <li class="active">All Projects</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'reviews.show')    
    <section class="content-header">
        <h1>
            Reviews
            <small>Project</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('reviews.index') }}"><i class="fa fa-dashboard"></i> Reviews</a></li>
            <li class="active">Project</li>
        </ol>
    </section>
@endif
<!-- end -->

<!-- Allocation -->
@if (Route::current()->getName() == 'allocations.index')
    <section class="content-header">
        <h1>
            Allocations
            <small>Budget Types</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('allocations.index') }}"><i class="fa fa-dashboard"></i> Allocations</a></li>
            <li class="active">Budget Types</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'allocations.type')
    <section class="content-header">
        <h1>
            Allocations
            <small>Sub Budget Types</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('allocations.index') }}"><i class="fa fa-dashboard"></i> Allocations</a></li>
            <li class="active">Sub Budget Types</li>
        </ol>
    </section>
@endif
<!-- End -->

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

@if (Route::current()->getName() == 'users.edit')
    <section class="content-header">
        <h1>
            Users
            <small>Update User</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('users.index') }}"><i class="fa fa-dashboard"></i> Users</a></li>
            <li class="active">Update User</li>
        </ol>
    </section>
@endif
<!-- end -->

<!-- Role -->
@if (Route::current()->getName() == 'roles.index')
    <section class="content-header">
        <h1>
            Roles
            <small>All Roles</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('roles.index') }}"><i class="fa fa-dashboard"></i> Roles</a></li>
            <li class="active">All Roles</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'roles.edit')
    <section class="content-header">
        <h1>
            Roles
            <small>Update Role</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('roles.index') }}"><i class="fa fa-dashboard"></i> Roles</a></li>
            <li class="active">Update Role</li>
        </ol>
    </section>
@endif
<!-- end -->

<!-- Section -->
@if (Route::current()->getName() == 'sections.index')
    <section class="content-header">
        <h1>
            Sections
            <small>All Sections</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('sections.index') }}"><i class="fa fa-dashboard"></i> Sections</a></li>
            <li class="active">All Sections</li>
        </ol>
    </section>
@endif

@if (Route::current()->getName() == 'sections.edit')
    <section class="content-header">
        <h1>
            Sections
            <small>Update Section</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('sections.index') }}"><i class="fa fa-dashboard"></i> Sections</a></li>
            <li class="active">Update Section</li>
        </ol>
    </section>
@endif
<!-- end -->

<!-- Unit -->
@if (Route::current()->getName() == 'units.index')
    <section class="content-header">
        <h1>
            Units
            <small>All Units</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('units.index') }}"><i class="fa fa-dashboard"></i> Units</a></li>
            <li class="active">All Units</li>
        </ol>
    </section>
@endif
<!-- end -->