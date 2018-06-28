@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Planned Assessments' ] )
        @include('judi.partials/_assessments', ['assessments' => $assessments])
    </div>
@stop