@extends('emails.email_master')

@section('content')
    <p>Hello</p>

    <p>
        {!! $learner->first_name !!} {!! $learner->surname !!} (IDENT: {!! $learner->ident !!}) has been assigned the
        following key code. Please add this to their PICS record.
    </p>

    <p><strong>Key Code: </strong> {!! $learner->key !!}</p>

    <p>Thanks</p>

    <p>
        <strong>KeySafe@VanDango</strong>
    </p>
@stop