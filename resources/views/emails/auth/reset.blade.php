@extends('emails.email_master')

@section('content')
	<h1>Password Reset</h1>
	<p>Hi there</p>
	<p>We have just received a request to reset your password, if this is correct please follow the instructions below, otherwise just ignore this email and have a great day!</p>
	<p>You can {!! link_to('password/reset/'.$token, 'reset your password here') !!}.</p>
	<p>If you have any problems please {!! link_to("mailto:portal@totalpeople.co.uk?subject=VanDango Password Reset Issue", 'email VanDango') !!}.</p>
	<p>Thank you</p>
	<p><strong>{!! Config::get('vandango.site') !!}</strong></p>
@stop