@extends('emails.email_master')

@section('content')
    <h1>Course Update</h1>
    <p>Hello {!! $user->first_name !!}</p>
    <p>
        This is to let you know that there has been a change to a course you are due to attend. Please find below the
        updated information.
    </p>

    <ul>
        <li>
            <strong>Course/Qualification: </strong>
            {!! $timetable->course->name !!}
        </li>
        <li>
            <strong>Venue: </strong>
            {!! $timetable->venue->name !!}, {!! $timetable->venue->site->location->town !!}
        </li>
        <li>
            <strong>Date/Time: </strong>
            {!! $timetable->starts_at->format('d/m/Y H:i') !!} - {!! $timetable->ends_at->format('d/m/Y H:i') !!}
        </li>
    </ul>

    <p>
        For any reason that you cannot attend this professional practice please let us know. Total people values
        development and we are looking forward to inspire and improve your skills and knowledge.
    </p>

    <p>Thank you</p>
    <p><strong>Total People</strong></p>
@stop