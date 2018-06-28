<div class="panel panel-default">
    <div class="panel-head"><h4>Filter Summaries</h4></div>

    <div class="panel-body">
        {!! Form::open( ['route' => 'judi.dashboard', 'class' => 'form-horizontal', 'method' => 'get' ]) !!}
        <div class="form-group">
            {!! Form::label('Date From') !!}
            <datepicker
                    field-name="date_from"
                    value="{!! request('date_from', Carbon\Carbon::now()->subMonth()->format('d/m/Y')) !!}"
                    min-date="null">
            </datepicker>
        </div>

        <div class="form-group">
            {!! Form::label('Date To') !!}
            <datepicker
                    field-name="date_to"
                    value="{!! request('date_to', Carbon\Carbon::now()->subMonth()->format('d/m/Y')) !!}"
                    min-date="null">
            </datepicker>
        </div>

        <div class="form-group">
            <div class="form-label">
                <checkbox-toggle criteria="grade_id"></checkbox-toggle>
                {!! Form::label('Grade') !!}
            </div>
            <ul class="list-unstyled">
                @foreach ($grades as $grade)
                    <li>
                        <ul class="list-inline">
                            <li>{!! Form::checkbox( 'grade_id[]', $grade->id, checkboxState($grade->id, Request::get('grade_id')), ['id' => 'grade_id_' . $grade->id, 'class' => 'grade_id']) !!}</li>
                            <li>{!! $grade->name !!}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="form-group">
            <div class="form-label">
                <checkbox-toggle criteria="process_id"></checkbox-toggle>
                {!! Form::label('Processes') !!}
            </div>
            <ul class="list-unstyled">
                @foreach ($processes as $process)
                    <li>
                        <ul class="list-inline">
                            <li>{!! Form::checkbox( 'process_id[]', $process->id, checkboxState($process->id, Request::get('process_id')), ['id' => 'process_id_' . $process->id, 'class' => 'process_id']) !!}</li>
                            <li>{!! $process->name !!}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="form-group">
            <div class="form-label">
                <checkbox-toggle criteria="sector_id"></checkbox-toggle>
                {!! Form::label('Sectors') !!}
            </div>
            <ul class="list-unstyled overflow">
                @foreach ($sectors as $sector)
                    <li>
                        <ul class="list-inline">
                            <li>{!! Form::checkbox( 'sector_id[]', $sector->id, checkboxState($sector->id, Request::get('sector_id')), ['id' => 'sector_id_' . $sector->id, 'class' => 'sector_id']) !!}</li>
                            <li>{!! $sector->name !!}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        {!! Form::submit('Search', array('class' => 'btn btn-secondary btn-block')) !!}
        {!! Form::close() !!}

    </div>
</div>