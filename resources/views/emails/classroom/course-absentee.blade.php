@extends('emails.email_master')

@section('content')
    <h1>Course Absence</h1>

    <p>Hello {!! $user->first_name !!}</p>

    <p>
        We are just making sure that you are okay, you had a planned course / professional practice today and you have
        not attended. Can you please contact {!! $timetable->trainer->present()->name !!} so that we can review this and
        make arrangements to reflect on this.
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

    <p>Thank you</p>
    <p><strong>Classroom@VanDango</strong></p>
@stop