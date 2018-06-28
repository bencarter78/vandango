@extends('emails.email_master')

@section('content')
	<p>Hi</p>
	<p>{!! $application !!} has reported the following error. Probably worth an investigation in the logs.</p>
	<p><strong>{!! $processName or 'Process Name Unavailable' !!}</strong></p>
	<p>{!! $error->getMessage() !!}</p>
	<p>{!! $error->getTraceAsString() !!}</p>
	<p>Thanks</p>
	<p>VanDango</p>
@stop