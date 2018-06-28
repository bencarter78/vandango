@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Edit A Course</h4>
                </div>

                <div class="panel-body">
                    <blink-courses-form
                            :course="{{ htmlspecialchars(json_encode($course->load('awardingBody', 'sector')), ENT_QUOTES) }}"
                            url="{{ route('api.blink.courses.update', $course->id) }}" method="put" />
                </div>
            </div>
        </div>
    </div>
@stop