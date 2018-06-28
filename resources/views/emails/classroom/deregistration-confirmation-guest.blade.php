@extends('emails.totalpeople_email_master')

@section('content')
    <p>Hello {!! $user->first_name !!}</p>
    <p>
        This is confirmation that your upcoming place on the <strong>{!! $timetable->course->name !!}</strong> course
        has been cancelled. Hopefully, you already know why this has happened and that is great, otherwise please
        contact Total People to review this. Hopefully we will see you at a future course.
    </p>
    <p>Thank you</p>
    <p><strong>Total People</strong></p>
@stop