@extends('emails.email_master')

@section('content')
	<h1>New Password</h1>
	<p>Hello there</p>
	<p>We have reset your password to a temporary one for so your new password is:</p>
	<p><strong>{!! $newPassword !!}</strong></p>
	<p>We recommend you visit your profile page and update your password to something more memorable.</p>
	<p>If you have any problems please <a href="mailto:portal@totalpeople.co.uk?subject=VanDango Activation Issue">email VanDango</a></p>
	<p>Thank you</p>
	<p><strong>{!! Config::get('vandango.site') !!}</strong></p>
@stop