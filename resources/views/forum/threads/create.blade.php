@extends('layouts.master')

@section('content')
    @component('forum.partials._page-content', ['channels' => $channels])
        @slot('title')
            <h4>Create a Question</h4>
        @endslot
        <forum-thread-add :user-id="{{ $currentUser->id }}" channels-data="{!! htmlspecialchars(json_encode($channels), ENT_QUOTES) !!}"/>
    @endcomponent
@stop