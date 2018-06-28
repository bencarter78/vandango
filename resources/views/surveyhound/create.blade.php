@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        @include('partials/panels/_heading', [
        	'title' => 'Create Survey',
        ] )
        <div class="panel-body">
            {!! Form::open( ['route' => 'surveyhound.store', 'class' => '' ]) !!}
            @include('surveyhound.partials._form', ['submit' => 'Create'])
            {!! Form::close() !!}
        </div>
    </div>

@stop