@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Edit Applicant</h4>
                </div>
                <div class="panel-body">
                    <apply-applicant-form
                            user-id="{!! $currentUser->id !!}"
                            request-method="update"
                            redirect-url="{!! url()->previous() !!}">
                    </apply-applicant-form>
                </div>
            </div>
        </div>
    </div>
@stop