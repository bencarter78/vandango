@extends('layouts.master')

@section('content')
    <div class="has-actions">
        <probation-users has-access="{!! $currentUser->hasAccess('hr') !!}"></probation-users>
    </div>
@stop