<li class="nav-item <?= @$child_nav == 'dashboard' ? 'active bg-gray' : '' ?>">
    <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="far fa-regular fa-image nav-icon"></i>
        <p>{{ __('Dashboard') }}</p>
    </a>
    </li>

<li class="nav-item  <?= @$parent_nav == 'item' ? 'active menu-open' : '' ?>">
    <a href="#" class="nav-link ">

        <i class="far fa-file-alt nav-icon"></i>
        <p>{{ __('Item') }}</p>
        <i class="right fas fa-angle-left"></i>
    </a>
    <ul class="nav nav-treeview pl-3">
        
        <li class="nav-item <?= @$child_nav == 'crud' ? 'active bg-gray' : '' ?>">
            <a href="{{ route('admin.crud.index') }}" class="nav-link">
                <i class="far fa-file-alt nav-icon"></i>
                <p>{{ __('CRUD') }}</p>
            </a>
        </li>
    </ul>
</li>