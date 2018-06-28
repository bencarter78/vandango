@extends('layouts.master')

@section('content')
    <ignite-campaigns-report :campaigns="{{ htmlspecialchars(json_encode($campaigns), ENT_QUOTES) }}"/>
@stop