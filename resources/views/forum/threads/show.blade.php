@extends('layouts.master')

@section('content')
    @component('forum.partials._page-content')
        @slot('title')
            <forum-thread-heading
                    :user-id="{{ $currentUser->id }}"
                    :has-subscribed="{{ json_encode($thread->subscribers->pluck('id')->contains($currentUser->id)) }}"
                    thread-data="{{ htmlspecialchars(json_encode($thread), ENT_QUOTES) }}"/>
        @endslot
        <forum-thread thread-data="{{ htmlspecialchars(json_encode($thread), ENT_QUOTES) }}" :user-id="{{ $currentUser->id }}"/>
    @endcomponent
@stop