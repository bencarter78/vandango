@extends('layouts.master')

@section('content')
    <apply-unmatched
            has-access="{!! $currentUser->hasAccess('applyAdmin') !!}"
            user-id="{!! $currentUser->id !!}">
    </apply-unmatched>
@stop