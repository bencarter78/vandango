@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{!! $keys->count() !!} Assigned Learner Keys</h4>
        </div>
        <div class="table-responsive">
            <key-list keys="{!! htmlspecialchars($keys->toJson(), ENT_QUOTES, 'UTF-8') !!}"></key-list>
        </div>
    </div>
@stop