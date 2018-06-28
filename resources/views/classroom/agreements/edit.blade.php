@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Learning Agreement</h4>
        </div>
        <div class="panel-body">
            <div class="spacer-bottom-3x">
                <h4>Course Details</h4>
                <ul class="list-unstyled">
                    <li class="padding-bottom-1x">
                        <strong>Learner Name:</strong> {!! $agreement->user->present()->name !!}
                    </li>
                    <li class="padding-bottom-1x">
                        <strong>Course/Qualification:</strong> {!! $agreement->timetable->course->name !!}
                    </li>
                    <li class="padding-bottom-1x">
                        <strong>Start Date:</strong> {!! $agreement->timetable->starts_at->format('jS F Y') !!}
                    </li>
                    <li class="padding-bottom-1x">
                        <strong>End Date:</strong> {!! $agreement->timetable->starts_at->format('jS F Y') !!}
                    </li>
                </ul>
            </div>

            <h4>Declaration</h4>
            <p>
                If you leave Total People within 1 year following completion of any course that is externally
                accredited, you will be required to repay the amount below, as outlined in this agreement. This money
                will be taken from any final salary payment made.
            </p>

            <div class="alert alert-info spacer-top-3x">
                <p>
                    <strong>
                        <i class="fa fa-info-circle"></i>
                        Total cost to repay £{!! $cost !!}
                    </strong>
                </p>
            </div>

            <a class="spacer-top-2x btn btn-secondary btn-lg" data-toggle="modal" data-target="#myModal">
                I Agree
            </a>
        </div>
    </div>
@stop

@section('modalContent')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form class="form" action="{!! route('classroom.me.learning-agreements.destroy', $agreement->id) !!}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Please Confirm Your Password</h4>
                    </div>
                    <div class="modal-body">
                        {!! csrf_field() !!}
                        <input type="hidden" value="DELETE" name="_method">
                        <input type="hidden" value="true" name="is_signed">
                        <div class="form-group">
                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary btn-lg">I Agree</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@stop