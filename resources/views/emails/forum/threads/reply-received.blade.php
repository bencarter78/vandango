@extends('emails.email_master')

@section('content')
    <p>Hi</p>
    <p>This is to let you know that the forum thread you have subscribed to has had a new reply.</p>
    <p>{{ $reply->owner->fullName }} says...{{ strip_tags($reply->body) }}</p>
    <p>
        To unsubscribe from these updates,
        {{ link_to_route('forum.threads.show', 'visit the thread', $reply->thread->slug) }} and click 'Unsubscribe'.
    </p>
    <p>Thanks</p>
    <p><strong>VanDango</strong></p>
@stop