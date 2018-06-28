<li><a href="{{ route('forum.threads.index') }}">Forum</a></li>

@if($currentUser->hasAccess('forumAdmin') )
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin</a>
        <ul class="dropdown-menu">
            <li><a href="{!! URL::route('forum.channels.create') !!}">Create Channel</a></li>
        </ul>
    </li>
@endif