<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Sector</th>
            <th>Process</th>
            <th>Grade</th>
            <th>Submitted</th>
            <th>Outcome</th>
        </tr>
        </thead>
        @foreach($data as $summary)
            <tr>
                <td>{!! link_to_route('judi.assessments.user.submitted', $summary->assessment->user->present()->name, $summary->assessment->user->id) !!}</td>
                <td>
                    <a href="{!! URL::route('judi.sectors.show', $summary->assessment->sector->id) !!}">
                        {!! $summary->assessment->sector->name !!}
                    </a>
                </td>
                <td>{!! $summary->assessment->process->name !!}</td>
                <td>{!! $summary->grade->name !!}</td>
                <td>
                    {!! $summary->assessment->deleted_at->format('d/m/Y') !!} <br>
                    <small class="">
                        Due: {!! $summary->assessment->assessment_date->format('d/m/Y') !!}
                        {!! $summary->assessment->present()->timeliness !!}
                    </small>
                </td>
                <td>
                    @if($summary->grade->name == 'Requires Improvement' || $summary->grade->name == 'Inadequate')
                        {!! $summary->outcome or 'Pending' !!}
                    @else
                        {!! 'N/A' !!}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    <div>{!! $data->appends(Request::all())->render() !!}</div>
</div>