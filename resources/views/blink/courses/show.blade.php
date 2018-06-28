@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{ $course->title }}</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Sector</th>
                        <td>{{ $course->sector->title }}</tr>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>{{ $course->type }}</td>
                    </tr>
                    <tr>
                        <th>Framework Expiry Date</th>
                        <td>{{ $course->framework_expires_on }}</td>
                    </tr>
                    <tr>
                        <th>Code</th>
                        <td>{{ $course->code }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $course->description }}</td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td>{{ $course->level }}</td>
                    </tr>
                    <tr>
                        <th>Capability</th>
                        <td>{{ $course->capability }}</td>
                    </tr>
                    <tr>
                        <th>Awarding Body</th>
                        <td>{{ $course->awardingBody->name }}</tr>
                    </tr>
                    <tr>
                        <th>EPA Provider</th>
                        <td>{{ $course->epa_provider }}</td>
                    </tr>
                    <tr>
                        <th>Aim Ref Standard</th>
                        <td>{{ $course->aim_ref_standard }}</td>
                    </tr>
                    <tr>
                        <th>Aim Ref Mandatory</th>
                        <td>{{ $course->aim_ref_mandatory }}</td>
                    </tr>
                    <tr>
                        <th>Aim Ref Optional</th>
                        <td>{{ $course->aim_ref_optional }}</td>
                    </tr>
                    <tr>
                        <th>Programme Length (16-18)</th>
                        <td>{{ $course->programme_length }}</td>
                    </tr>
                    <tr>
                        <th>Programme Length (Adult)</th>
                        <td>{{ $course->programme_length_adult }}</td>
                    </tr>
                    <tr>
                        <th>Total Training</th>
                        <td>£{{ number_format($course->total_training) }}</td>
                    </tr>
                    <tr>
                        <th>Total Epa</th>
                        <td>£{{ number_format($course->total_epa) }}</td>
                    </tr>
                    <tr>
                        <th>Total Negotiated</th>
                        <td>£{{ number_format($course->total_negotiated) }}</td>
                    </tr>
                    <tr>
                        <th>Funding Band</th>
                        <td>£{{ number_format($course->funding_band) }}</td>
                    </tr>
                    <tr>
                        <th>Funding Cap</th>
                        <td>£{{ number_format($course->funding_cap) }}</td>
                    </tr>
                    <tr>
                        <th>Co Investment</th>
                        <td>£{{ number_format($course->co_investment) }}</td>
                    </tr>
                    <tr>
                        <th>Employer Contribution</th>
                        <td>£{{ number_format($course->employer_contribution) }}</td>
                    </tr>
                    <tr>
                        <th>Additional Delivery</th>
                        <td>£{{ number_format($course->additional_delivery) }}</td>
                    </tr>
                    <tr>
                        <th>Total Contribution</th>
                        <td>£{{ number_format($course->total_contribution) }}</td>
                    </tr>
                    <tr>
                        <th>Provider Incentive</th>
                        <td>£{{ number_format($course->provider_incentive) }}</td>
                    </tr>
                    <tr>
                        <th>Provider Uplift</th>
                        <td>£{{ number_format($course->provider_uplift) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@stop