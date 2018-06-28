@extends('emails.email_master')

@section('content')
	<p>Hi {!! $user->first_name !!}</p>
	<p>The {!! $sector->name !!} Performance Assessment has now been generated. Please <a href="{!! URL::route('judi.sectors.show', $sector->id) !!}">login to VanDango</a> and review these to make sure you're happy.</p>
	<p>If you have any problems, please contact {!! Config::get('vandango.judiAdminName') !!}</p>
	<p>Thank you</p>
	<p><strong>Judi@VanDango</strong></p>
@stop