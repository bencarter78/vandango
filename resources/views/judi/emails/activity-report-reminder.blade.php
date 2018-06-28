@extends('emails.email_master')

@section('content')
    <p>Hi {!! $user->first_name !!}</p>
    <p>Thank you for completing the PA activity for {!! $assessment->sector->name !!}.</p>
    <p>Please complete the attached activity report and forward to Fiona Thornton.</p>
    <p>Thank you</p>
    <p><strong>Judi@VanDango</strong></p>
@stop
