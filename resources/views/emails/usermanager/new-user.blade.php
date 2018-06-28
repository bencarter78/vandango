@extends('emails.email_master')

@section('content')
    <h1>New Staff Member</h1>
    <p>Hello {!! $user->first_name !!}</p>
    <p>This is a notification to inform you that <strong>{!! $newUser->present()->name !!}</strong> has been added to your team on VanDango.</p>

    <h4>What do you need to do?</h4>
    <p>Please log onto to VanDango and <a href="{!! URL::route('account.edit', $newUser->username) !!}">update {!! $newUser->first_name !!}'s sectors they work in and job roles</a>.</p>

    <h4>Why It's Important</h4>
    <p>Your new member staff <strong>WILL NOT</strong> be scheduled for their Probation Performance Assessment until you have completed this activity.</p>

    <p>Thank you</p>
    <p><strong>{!! Config::get('vandango.site') !!}</strong></p>
@stop