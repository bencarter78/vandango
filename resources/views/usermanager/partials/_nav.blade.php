@if($currentUser->hasAccess('admin'))
    <li>
        <a href="{!! URL::route('users.dashboard') !!}">Dashboard</a>
    </li>
@endif

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users</a>
    <ul class="dropdown-menu">
        <li>
            <a href="{!! URL::route('users.index') !!}">
                <i class="fa fa-fw fa-list"></i> All Users
            </a>
        </li>
        <li>
            <a href="{!! URL::route('users.register') !!}">
                <i class="fa fa-fw fa-plus-circle"></i> Register User
            </a>
        </li>
        <li>
            <a href="{!! URL::route('users.trashed') !!}">
                <i class="fa fa-fw fa-trash"></i> User Trash
            </a>
        </li>
        @if($currentUser->hasAccess('hr'))
            <li>
                <a href="{!! URL::route('users.probation') !!}">
                    <i class="fa fa-fw fa-calendar"></i> Probation Users
                </a>
            </li>
        @endif
    </ul>
</li>

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Departments</a>
    <ul class="dropdown-menu">
        <li>
            <a href="{!! URL::route('departments.index') !!}">
                <i class="fa fa-fw fa-list"></i> All Departments
            </a>
        </li>
        <li>
            <a href="{!! URL::route('departments.create') !!}">
                <i class="fa fa-fw fa-plus-circle"></i> Register Department
            </a>
        </li>
        <li>
            <a href="{!! URL::route('usermanager.trash', 'departments') !!}">
                <i class="fa fa-fw fa-trash"></i> Department Trash
            </a>
        </li>
    </ul>
</li>

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sectors</a>
    <ul class="dropdown-menu">
        <li>
            <a href="{!! URL::route('sectors.index') !!}">
                <i class="fa fa-fw fa-list"></i> All Sectors
            </a>
        </li>
        <li>
            <a href="{!! URL::route('sectors.create') !!}">
                <i class="fa fa-fw fa-plus-circle"></i> Register Sector
            </a>
        </li>
        <li>
            <a href="{!! URL::route('usermanager.trash', 'sectors') !!}">
                <i class="fa fa-fw fa-trash"></i> Sector Trash
            </a>
        </li>
    </ul>
</li>

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Roles</a>
    <ul class="dropdown-menu">
        <li>
            <a href="{!! URL::route('roles.index') !!}">
                <i class="fa fa-fw fa-list"></i> All Roles
            </a>
        </li>
        <li>
            <a href="{!! URL::route('roles.create') !!}">
                <i class="fa fa-fw fa-plus-circle"></i> Register Role
            </a>
        </li>
        <li>
            <a href="{!! URL::route('usermanager.trash', 'roles') !!}">
                <i class="fa fa-fw fa-trash"></i> Role Trash
            </a>
        </li>
    </ul>
</li>

@if($currentUser->hasAccess('admin'))
    <li>
        <a href="{!! URL::route('groups.index') !!}">Groups</a>
    </li>
@endif