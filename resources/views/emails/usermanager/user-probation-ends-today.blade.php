@extends('emails.email_master')

@section('content')
    <h1>Probation Ended?</h1>
    <p>Hello {!! $user->first_name !!}</p>
    <p>According to VanDango, <strong>{!! $staff->present()->name !!}</strong>'s probation ends today.</p>

    <h3>What do you need to do?</h3>
    <p>Please <a href="{!! URL::route('account.edit', $staff->username) !!}">update {!! $staff->first_name !!}'s probation end date</a> by clicking on the HR tab (on the left hand side) and then either:</p>
    <ul>
        <li>Delete the date from the probation end date field.</li>
        <li>Change the date if you are/have extended the probation period.</li>
    </ul>

    <p>Thank you</p>
    <p><strong>{!! Config::get('vandango.site') !!}</strong></p>
@stop