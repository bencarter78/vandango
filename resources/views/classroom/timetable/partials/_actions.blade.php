<ul class="list-inline">
    <li>
        {{--<button-user-attended user-id="{!! $user->id !!}"></button-user-attended>--}}
    </li>

    <li>
        <a class="btn btn-danger btn-sm" role="button" data-target="#modal_{!! $type !!}_{!! $user->id !!}" data-toggle="modal">
            <i class="fa fa-times"></i>
        </a>
    </li>

    <li>
        <a class="btn btn-circle btn-danger btn-sm" role="button" data-target="#modal_{!! $type !!}_{!! $user->id !!}" data-toggle="modal">
            <i class="fa fa-trash"></i>
        </a>
    </li>
</ul>

<course-delete-attendee
        timetable-id="{!! $timetableId !!}"
        attendee-id="{!! $user->id !!}"
        modal-id="{!! $type . '_' . $user->id !!}"
        type={!! $type !!}
></course-delete-attendee>