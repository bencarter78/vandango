@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <ul class="list-inline">
                    <li>{!! $vacancy->title !!}</li>
                </ul>
            </h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 spacer-bottom-3x">
                    @include('blink.vacancies._partials._sidebar')
                </div>

                <div class="col-md-9">
                    @include('blink.vacancies._partials._table-vacancy-detail')
                </div>
            </div>
        </div>
    </div>
@stop