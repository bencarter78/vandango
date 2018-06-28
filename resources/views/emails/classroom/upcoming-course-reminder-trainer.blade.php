@extends('emails.email_master')

@section('content')
    <h1>Upcoming Course Reminder</h1>

    <p>Hello {!! $timetable->trainer->first_name !!}</p>

    <p>
        Here are the attendees for your upcoming course.
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

    <h4>Attendees</h4>
    <ul>
        @foreach($timetable->users as $user)
            <li>{!! $user->present()->name !!}</li>
        @endforeach

        @foreach($timetable->guests as $user)
            <li>{!! $user->present()->name !!}</li>
        @endforeach
    </ul>

    <p>Thank you</p>
    <p><strong>Classroom@VanDango</strong></p>
@stop