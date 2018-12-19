<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills nav-justified thumbnail thumbnail-custom setup-panel">
            <li class="{{ request()->is('*initial*') ? 'active-custom' : '' }}">
                <a href="{{ route('projects.show', $project->id) }}">
                    <p class="list-group-item-heading nav-font-custom">Permulaan</p>
                </a>
            </li>
            <li class="{{ request()->is('*planning*') ? 'active-custom' : '' }}">
                <a href="{{ route('info.index', $project->id) }}">
                    <p class="list-group-item-heading nav-font-custom">Perancangan</p>
                </a>
            </li>
            <li class="{{ request()->is('*collection*') ? 'active-custom' : '' }}">
                <a href="{{ route('collection.project.information', $project->id) }}">
                    <p class="list-group-item-heading nav-font-custom">Perolehan</p>
                </a>
            </li>
            <li class="{{ request()->is('*development*') ? 'active-custom' : '' }}">
                <a href="{{ route('development.project.information', $project->id) }}">
                    <p class="list-group-item-heading nav-font-custom">Pembangunan</p>
                </a>
            </li>
            <li class="{{ request()->is('*termination*') ? 'active-custom' : '' }}">
                <a href="{{ route('deliverables.index', $project->id) }}">
                    <p class="list-group-item-heading nav-font-custom">Penamatan</p>
                </a>
            </li>
        </ul>
    </div>
</div>