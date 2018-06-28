@extends('layouts.master')
@section('content')
	<judi-sector-search
			has-access="{!! $currentUser->hasAccess('judiAdmin') !!}"
	        user="{!! $currentUser->id !!}"
	></judi-sector-search>
@stop