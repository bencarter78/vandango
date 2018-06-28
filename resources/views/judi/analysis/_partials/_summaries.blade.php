<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Sector</th>
            <th>Process</th>
            <th>Grade</th>
            <th>Assessed</th>
        </tr>
        </thead>
        @foreach($data as $summary)
            <tr>
                <td>{!! link_to_route('judi.summaries.show', $summary->first_name . ' ' . $summary->surname, $summary->summary_id) !!}</td>
                <td>
                    <a href="{!! URL::route('judi.sectors.show', $summary->sector_id) !!}">
                        {!! $summary->name !!}
                    </a>
                </td>
                <td>{!! $summary->process_name !!}</td>
                <td>{!! $summary->grade_name !!}</td>
                <td>{!! Carbon\Carbon::createFromFormat('Y-m-d', $summary->assessment_date)->format('d/m/Y') !!}</td>
            </tr>
        @endforeach
    </table>
</div>