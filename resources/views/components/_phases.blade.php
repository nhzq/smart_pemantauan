<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills nav-justified thumbnail setup-panel">
            <li class="{{ request()->is('*initial*') ? 'active' : '' }}">
                <a href="{{ route('projects.show', $project->id) }}">
                    <p class="list-group-item-heading">Permulaan</p>
                </a>
            </li>
            <li class="{{ request()->is('*planning*') ? 'active' : '' }}">
                <a href="{{ route('info.index', $project->id) }}">
                    <p class="list-group-item-heading">Perancangan</p>
                </a>
            </li>
            <li class="{{ request()->is('*collection*') ? 'active' : '' }}">
                <a href="{{ route('collection.project.information', $project->id) }}">
                    <p class="list-group-item-heading">Perolehan</p>
                </a>
            </li>
            <li class="{{ request()->is('*development*') ? 'active' : '' }}">
                <a href="{{ route('development.project.information', $project->id) }}">
                    <p class="list-group-item-heading">Pembangunan</p>
                </a>
            </li>
            <li class="">
                <a href="">
                    <p class="list-group-item-heading">Penamatan</p>
                </a>
            </li>
        </ul>
    </div>
</div>