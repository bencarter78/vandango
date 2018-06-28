@extends('layouts.master')

@section('content')
    @component('forum.partials._page-content')
        @slot('title')
            @if($channel->name)
                <span class="pull-right">
                <forum-subscriber
                        :has-subscribed="{{ json_encode(App\Forum\User::find($currentUser->id)->isSubscribedTo($channel)) }}"
                        url="/api/v1/forum/channels/{{ $channel->slug }}/subscriptions"
                        :user-id="{{ $currentUser->id }}"/>
                </span>
            @endif
            <h4>
                All
                @if($channel)
                    {{ $channel->name }}
                @endif
                @if(request('by'))
                    {{ App\Forum\User::where('username', request('by'))->first()->fullName }}'s
                @endif
                Threads
            </h4>
        @endslot
        @include('forum.partials._threads')
    @endcomponent
@stop