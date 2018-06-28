<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h4>Summaries Requiring Outcomes</h4>
            </div>
            @if($data)
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Sector</th>
                            <th>Process</th>
                            <th>Grade</th>
                            <th>Assessment Date</th>
                            <th>Outcome</th>
                        </tr>
                        </thead>
                        @foreach($data as $summary)
                            <tr>
                                <td>{!! $summary->assessment->user->present()->name !!}</td>
                                <td>{!! $summary->assessment->sector->name !!}</td>
                                <td>{!! $summary->assessment->process->name !!}</td>
                                <td>{!! $summary->grade->name !!}</td>
                                <td>{!! $summary->assessment_date->format('d/m/Y') !!}</td>
                                <td>
                                    {!! Form::model($summary, [ 'route' => [ 'judi.summaries.outcome', $summary->id ], 'method' => 'put', 'class' => 'form-inline' ] ) !!}
                                    {!! Form::select('outcome', [ null => 'Please select...', 'Monitor by manager' => 'Monitor by manager', 'Sector standardisation' => 'Sector standardisation', 'Training Required (L&D)' => 'Training Required (L&D)'], null, ['class' => 'form-control' ]) !!}
                                    {!! Form::submit('Submit', [ 'name' => 'submit', 'class' => 'btn btn-secondary' ]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="panel-footer">{!! $data->render() !!}</div>
            @endif
        </div>
    </div>
</div>