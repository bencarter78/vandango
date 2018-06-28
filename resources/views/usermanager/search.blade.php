@extends('layouts.master')

@section('content')
    <div class="has-actions">
        <user-search has-access="{!! $currentUser->hasAccess('hr') !!}"></user-search>
    </div>
@stop