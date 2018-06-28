@extends('emails.email_master')

@section('content')
    <p>Hi {!! $user->first_name !!}</p>
    <p>
        {!! $summary->assessment->user->present()->name !!} has been graded as {!! $summary->grade->name !!} in
        a {!! $summary->assessment->sector->name !!} {!! $summary->assessment->process->name !!} assessment.
    </p>
    <p>You are now required to select a training/development outcome for them.</p>
    <p>To do so please visit the {!! link_to('judi', 'Judi Dashboard on VanDango') !!}, choose the relevant option and
        click submit.</p>
    <p>Thank you</p>
    <p><strong>Judi@VanDango</strong></p>
@stop