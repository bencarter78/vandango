@extends('emails.email_master')

@section('content')
	<p>Hi {!! $user->first_name !!}</p>
	<p>The following assessments are due this month.</p>
	<h4>You have {!! $assessments->count() !!} Assessments</h4>
	<ul>
		@foreach($assessments as $assessment)
			<li>{!! $assessment->user->present()->name !!} ({!! $assessment->sector->present()->sector !!}): {!! $assessment->process->name !!}</li>
		@endforeach
	</ul>
	<p>Please can you complete the assessment if it has not already been done and submit an assessment summary.</p>
	<p>If there are any problems please contact {!! Config::get('vandango.judiAdminName') !!}.</p>
	<p>Thank you</p>
	<p><strong>Judi@VanDango</strong></p>
@stop