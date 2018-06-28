@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Create A New Auditor Category', 'access' => 'auditorAdmin' ] )
        <div class="panel-body">
            {!! Form::open(array('route' => 'auditor.categories.store')) !!}
                @include('auditor/categories/partials/_form', ['submit' => 'Create'])
            {!! Form::close() !!}
        </div>
    </div>

@stop