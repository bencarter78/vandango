@extends('emails.email_master')

@section('content')
    <p>Hi {!! $user->first_name !!}</p>
    <p>This is just to let you know {!! $staff->present()->name !!} has now completed all of their Performance Assessments.</p>
    <p>You can {!! link_to_route('judi.assessments.user.submitted', 'view their grades here', $staff->id) !!}.</p>
    <p>Thank you</p>
    <p><strong>Judi@VanDango</strong></p>
@stop