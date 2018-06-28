@extends('emails.email_master')

@section('content')
	<p>Hi</p>
	<p>This is a request for the In-Learning lists for the following people.</p>
	@foreach($assessments as $assessment)
		<li>{!! $assessment->user->present()->name !!} ({!! $assessment->sector->present()->sector !!}) - Send to {!! $assessment->assessor->present()->name !!}</li>
	@endforeach
	<p>If there are any problems please contact {!! Config::get('vandango.judiAdminName') !!}.</p>
	<p>Thank you</p>
	<p><strong>Judi@VanDango</strong></p>
@stop