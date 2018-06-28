@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Create Non-Employed Applicant</h4>
                </div>
                <div class="panel-body">
                    <div class="alert alert-warning">
                        <p>
                            <i class="fa fa-warning"></i>
                            <strong class="text-upper">Please Note</strong>
                        </p>
                        <p>
                            Only non-employed identified starts (e.g. Study Programme, Traineeship, some ESF) should
                            be entered using this form. If you're start is employed, please use
                            <a href="{!! route('blink.enquiries.create') !!}" class="is-link">Blink</a> to add an
                            enquiry then enter the start on the enquiry page.
                        </p>
                    </div>

                    <apply-applicant-form
                            applicant="{!! new App\Apply\Models\Applicant() !!}"
                            request-method="store"
                            qualification-type="non_employed"
                            user-id="{!! $currentUser->id !!}"
                            redirect-url="{!! route('apply.me.applicants.index') !!}">
                    </apply-applicant-form>
                </div>
            </div>
        </div>
    </div>
@stop