@extends('emails.email_master')

@section('content')
    <p>Hi</p>
    <p>
        This is to let you know that a new forum thread has been created in the {{ $thread->channel->name }} channel,
        by {{ $thread->creator->fullName }}.
    </p>
    <p><strong>{{ $thread->title }}</strong></p>
    <p>{{ strip_tags($thread->body) }}</p>
    <p>You can view the thread {{ link_to_route('forum.threads.index', 'here', $thread->channel->slug) }}.</p>
    <p>
        To unsubscribe from these updates,
        {{ link_to_route('forum.threads.index', 'visit the channel', $thread->channel->slug) }} and click 'Unsubscribe'.
    </p>
    <p>Thanks</p>
    <p><strong>VanDango</strong></p>
@stop