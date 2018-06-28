@extends('emails.email_master')

@section('content')
	<h1>{!! $user->first_name !!}, welcome to {!! Config::get('vandango.site') !!}</h1>
    <p>Your VanDango account now been activated. To access VanDango click on the link below.</p>
	<p><strong>Password: {!! $password !!}</strong></p>
	<p>It is highly recommended that you change this password once you have logged in.</p>
	<p><a href="{!!  URL::to('/') !!}">Take me to VanDango.</a></p>
	<p>If you have any problems please <a href="mailto:portal@totalpeople.co.uk?subject=VanDango Login Issue">email VanDango</a></p>

    <p>Thank you</p>
    <p><strong>{!! Config::get('vandango.site') !!}</strong></p>
@stop