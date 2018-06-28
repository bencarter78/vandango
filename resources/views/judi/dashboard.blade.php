@extends('layouts.master')

@section('content')

    @if($currentUser->hasAccess('judiAdmin'))
        @include('judi.partials._summary-filter')
    @elseif($currentUser->hasAccess('judiSM'))
        @include('judi.partials._outcome-form')
    @endif

@stop