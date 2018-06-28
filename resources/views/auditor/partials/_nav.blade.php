<li><a href="{!! URL::to('auditor') !!}"><i class="fa fa-fw fa-home"></i> Auditor</a></li>

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tasks</a>
    <ul class="dropdown-menu">
        <li><a href="{!! URL::route('auditor.tasks.index') !!}"><i class="fa fa-fw fa-list"></i> All Tasks</a></li>
        @if($currentUser->hasAccess('auditorAdmin'))
            <li><a href="{!! URL::route('auditor.tasks.create') !!}"><i class="fa fa-fw fa-plus-circle"></i> Create Task</a></li>
            <li><a href="{!! URL::route('auditor.tasks.trashed') !!}"><i class="fa fa-fw fa-trash"></i> Trashed Tasks</a></li>
        @endif
    </ul>
</li>

<li><a href="{!! URL::route('auditor.categories.index') !!}">Categories</a></li>