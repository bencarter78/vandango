@extends('emails.email_master')

@section('content')
    <p>Hello {!! $user->first_name !!}</p>
    <p>
        This is confirmation that your upcoming place on the <strong>{!! $timetable->course->name !!}</strong> course
        has been cancelled. If you already know why this has happened then that’s great, otherwise can you please
        contact your manager to review this. Hopefully we will see you on a future course.
    </p>
    <p>Thank you</p>
    <p><strong>Classroom@VanDango</strong></p>
@stop