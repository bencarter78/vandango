@if($currentUser->isManager())
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-graduation-cap"></i> Classroom</a>
        <ul class="dropdown-menu">
            <li><a href="{!! URL::to('classroom') !!}"><i class="fa fa-fw fa-user"></i> My Classroom</a></li>
            <li><a href="{!! URL::to('classroom/manager') !!}"><i class="fa fa-fw fa-users"></i> Staff Classroom</a></li>
        </ul>
    </li>
@else
    <li><a href="{!! URL::to('classroom') !!}"><i class="fa fa-fw fa-graduation-cap"></i> Classroom</a></li>
@endif

@if($currentUser->hasAccess('classroomAdmin'))
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Timetable</a>
        <ul class="dropdown-menu">
            <li>
                <a href="{!! URL::route('classroom.timetable.index') !!}">
                    <i class="fa fa-fw fa-calendar"></i> Upcoming
                </a>
            </li>
            <li>
                <a href="{!! URL::route('classroom.timetable.index', ['expired' => true]) !!}">
                    <i class="fa fa-fw fa-archive"></i> Past
                </a>
            </li>
            <li>
                <a href="{!! URL::route('classroom.timetable.create') !!}">
                    <i class="fa fa-fw fa-plus-circle"></i> Add To Timetable
                </a>
            </li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Courses</a>
        <ul class="dropdown-menu">
            <li class="dropdown-header">Processes</li>
            <li><a href="{!! URL::route('classroom.courses.index') !!}"><i class="fa fa-fw fa-list"></i> All Courses</a>
            </li>
            <li>
                <a href="{!! URL::route('classroom.courses.create') !!}">
                    <i class="fa fa-fw fa-plus-circle"></i> Create Course
                </a>
            </li>
            <li><a href="#"><i class="fa fa-fw fa-trash"></i> Trashed Courses</a></li>
        </ul>
    </li>
@else
    <li><a href="{!! URL::to('classroom/timetable') !!}">Timetable</a></li>
@endif
