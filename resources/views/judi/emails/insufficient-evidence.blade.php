@extends('emails.email_master')

@section('content')
    <p>Hi {!! $user->first_name !!}</p>
    <p>
        {!! $summary->assessment->assessor->present()->name !!} has advised
        that {!! $summary->assessment->user->present()->name !!} has
        insufficient evidence to demonstrate their competence in
        {!! $summary->assessment->process->name !!}.
    </p>

    <p>
        {!! $summary->assessment->user->first_name !!} has been advised to
        contact {!! $summary->assessment->assessor->first_name !!} when evidence
        is available however this may be after the probation date is due.
    </p>

    <p>Thank you</p>
    <p><strong>Judi@VanDango</strong></p>
@stop