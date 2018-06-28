@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Upload Your CV</h4>
        </div>
        <div class="panel-body">
            <cpd-cv-upload :cv="{{ htmlspecialchars(json_encode($cv)) }}" />
        </div>
    </div>
@stop