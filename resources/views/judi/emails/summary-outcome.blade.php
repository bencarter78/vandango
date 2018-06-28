@extends('emails.email_master')

@section('content')
	<p>Hi {!! $user->first_name !!}</p>
	<p>{!! $summary->assessment->user->present()->name !!} has been graded as {!! $summary->grade->name !!} in a {!! $summary->assessment->sector->name !!} {!! $summary->assessment->process->name !!} assessment.</p>
	<p>The sector manager has identified that training is required from your sector.</p>
	<p>Thank you</p>
	<p><strong>Judi@VanDango</strong></p>
@stop