@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Create A Course</h4>
                </div>

                <div class="panel-body">
                    <blink-courses-form url="{{ route('api.blink.courses.store') }}" method="post" />
                </div>
            </div>
        </div>
    </div>
@stop