@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        @include('partials/panels/_heading', [ 'title' => 'Edit Category' ] )
        <div class="panel-body">
            {!! Form::model($category, array('route' => array('auditor.categories.update', $category->id), 'method' => 'patch') ) !!}
                @include('auditor/categories/partials/_form', ['submit' => 'Update'])
            {!! Form::close() !!}
        </div>
    </div>

@stop