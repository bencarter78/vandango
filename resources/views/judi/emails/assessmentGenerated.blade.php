@extends('emails.email_master')

@section('content')
    <p>Hi {!! $user->first_name !!}</p>
    <p>The following sectors' Performance Assessment has now been generated.</p>
	<ul>
		@foreach($sectors as $sector)
			<li>{!! $sector->name !!}</li>
		@endforeach
	</ul>

    <p>Thank you</p>
    <p><strong>Judi@VanDango</strong></p>
@stop