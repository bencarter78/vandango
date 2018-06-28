@extends('emails.email_master')

@section('content')
	<p>Hi {!! $user->first_name !!}</p>
	<p>The following assessment is showing as having 2 weeks left before the required by date is hit.</p>
	<h4>{!! $assessment->process->name !!}</h4>
	<ul>
		<li>{!! $assessment->user->present()->name !!} ({!! $assessment->sector->present()->sector !!})</li>
		<li>{!! $assessment->assessment_date->format('jS F Y')!!}</li>
	</ul>
	<p>Please can you complete the assessment if it has not already been done and submit an assessment summary.</p>
	<p>If there are any problems please contact {!! Config::get('vandango.judiAdminName') !!}.</p>
	<p>Thank you</p>
	<p><strong>Judi@VanDango</strong></p>
@stop