@extends('emails.email_master')

@section('content')
    <p>Hi</p>

    <p>
        The following email addresses have bounced and will need to be removed
        from PICS.
    </p>

    <ul>
        @foreach($recipients as $recipient)
            <li class="list-item">
                <strong>
                    {!! trim($recipient->firstname) !!} {!! trim($recipient->surname) !!}
                    @if($recipient->ident)
                        ({!! trim($recipient->ident) !!})
                    @endif
                    {!! trim($recipient->email) !!}
                </strong>
            </li>
        @endforeach
    </ul>

    <p>Thanks</p>
    <p><strong>Auditor @ VanDango</strong></p>
@stop