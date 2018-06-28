@extends('emails.totalpeople_email_master')

@section('content')
    <h1>Course Registration</h1>

    <p>Hello {!! $user->first_name !!}</p>

    <p>
        As part of your organisations professional practice you have been identified for the following course. Please
        make sure that you have planned in the date and time and are aware of the location. Lunch is not provided but
        refreshments are.
    </p>

    @if($timetable->course->cost > 0)
        <p>
            Our <a href="http://wp.me/a20RkF-5sx">Commercial Learning Agreement must be completed before the start of
                the course</a>, this is to register you with the awarding organisation and arrange payment.
        </p>
    @endif

    <ul>
        <li>
            <strong>Course/Qualification: </strong>
            {!! $timetable->course->name !!}
        </li>
        <li>
            <strong>Venue: </strong>
            {!! $timetable->venue->name !!} - {!! $timetable->venue->site->location->present()->address !!}
        </li>
        <li>
            <strong>Date/Time: </strong>
            {!! $timetable->starts_at->format('d/m/Y H:i') !!} - {!! $timetable->ends_at->format('d/m/Y H:i') !!}
        </li>
    </ul>

    <p>
        For any reason that you cannot attend this professional practice then you will need to review this with your
        manager so that the trainer can plan for this. Total people values development and we are looking forward to
        inspire and improve your skills and knowledge.
    </p>

    <p>Thank you</p>
    <p><strong>Total People</strong></p>
@stop