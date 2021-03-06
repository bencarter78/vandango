@extends('emails.email_master')

@section('content')
    <h1>Upcoming Course Reminder</h1>
    <p>Hello {!! $user->first_name !!}</p>
    <p>
        Just a quick reminder for about your upcoming course. As part of your professional practice you have been
        enrolled to the following course, please make sure that you have planned in the date and time and are aware of
        the location.
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

    @if($timetable->course->is_agreement_required)
        <h4>Learning Agreement Required</h4>
        <p>
            If you have not already signed your learning agreement then please click the link below to confirm this
            agreement.
        </p>
        <a href="{!! url('/classroom/me') !!}">Sign Your Learning Agreement.</a>
    @endif

    <p>
        For any reason that you cannot attend this professional practice then you will need to review this with your
        manager so that the trainer can plan for this. Total people values development and we are looking forward to
        inspire and improve your skills and knowledge.
    </p>

    <p>Thank you</p>
    <p><strong>Classroom@VanDango</strong></p>
@stop