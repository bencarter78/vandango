<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <div class="flex pt-1">
            <i class="fa fa-bell relative"></i>
            @if($currentUser->unreadNotifications->count() > 0)
                <div class="rounded-full -ml-3 z-10 -mt-1 w-4 h-4 bg-red"></div>
            @endif
        </div>
    </a>
    <ul class="dropdown-menu">
        @if($currentUser->notifications->count() > 0)
            @foreach($currentUser->notifications as $notification)
                <li>
                    <a class="is-link" href="{{ route('usermanager.users.notifications.index') }}">
                        <ul class="list-inline">
                            @if($notification->read_at)
                                <li><i class="fa fa-circle-o text-blue"></i></li>
                            @else
                                <li><i class="fa fa-circle text-blue"></i></li>
                            @endif
                            <li>
                                {!! $notification->data['title'] !!}
                            </li>
                        </ul>
                    </a>
                </li>
            @endforeach
        @else
            <li>
                <a>
                    You have no notifications
                </a>
            </li>
        @endif
    </ul>
</li>

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-th"></i></a>
    <ul class="dropdown-menu">
        <li><a href="{!! url('/') !!}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
        <li>
            <a href="{!! route('usermanager.users.notifications.index') !!}">
                <i class="fa fa-fw fa-bullhorn"></i>
                Notifications
            </a>
        </li>
        <li class="divider"></li>
        <li class="dropdown-header">My Applications</li>
        @foreach($apps as $app)
            <li>
                <a href="{!! url($app->slug) !!}">
                    <i class="fa fa-fw fa-{!! $app->icon !!}"></i>
                    {!! $app->title !!}
                </a>
            </li>
        @endforeach
    </ul>
</li>

<li class="dropdown {!! isElementActive(Request::segment(2), 'users') !!}">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-fw fa-user"></i>{!! $currentUser->present()->name !!}
    </a>

    <ul class="dropdown-menu">
        <li class="dropdown-header">Profile</li>
        <li>
            <a href="{!! route('account.show', $currentUser->username) !!}">
                <i class="fa fa-fw fa-user"></i> My Profile
            </a>
        </li>
        <li>
            <a href="{!! route('account.edit', $currentUser->username) !!}">
                <i class="fa fa-fw fa-pencil-square-o"></i> Edit Profile</a>
        </li>

        <li class="divider"></li>
        @if ($currentUser->hasAccess('hr') )
            <li class="dropdown-header">Admin</li>
            <li><a href="{!! route('users.index') !!}"><i class="fa fa-fw fa-list"></i> All Users</a></li>
            <li><a href="{!! route('users.register') !!}"><i class="fa fa-fw fa-plus-circle"></i> Register User</a></li>

            <li class="divider"></li>
            <li class="dropdown-header">Categories</li>
            <li><a href="{!! route('departments.index') !!}"><i class="fa fa-fw fa-archive"></i> Departments</a></li>
            <li><a href="{!! route('sectors.index') !!}"><i class="fa fa-fw fa-slideshare"></i> Sectors</a></li>
            <li><a href="{!! route('roles.index') !!}"><i class="fa fa-fw fa-cogs"></i> Job Roles</a></li>
            <li class="divider"></li>
        @endif

        <li>
            <a href="{{ url('/auth/logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-sign-out"></i> Logout
            </a>

            <form id="logout-form" action="{{ url('/auth/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>

    </ul>
</li>
