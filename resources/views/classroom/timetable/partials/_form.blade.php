{!! csrf_field() !!}

<div class="form-group spacer-bottom-3x">
    {!! Form::label('Course') !!}
    {!! Form::select(
        'course_id',
        dropdownOptions($courses, 'name'),
        isset($timetable->course_id) ? $timetable->course_id : '',
        ['class' => 'form-control']
    ) !!}
    @include('partials.forms._error', ['field' => 'course_id'])
</div>

<div class="form-group spacer-bottom-3x">
    {!! Form::label('Primary Trainer') !!}
    <search-users
            user_id="{!! old('user_id') ?: ((isset($timetable->trainer_id) ? $timetable->trainer_id : '')) !!}"
            user="{!! old('user') ?: ((isset($timetable->trainer) ? $timetable->trainer->present()->name : '')) !!}"
    ></search-users>
</div>

<div class="form-group spacer-bottom-3x">
    {!! Form::label('Venue/Room') !!}
    <venue-search
            room_id="{!! old('room_id') ?: ((isset($timetable->room_id) ? $timetable->room_id : '')) !!}"
            room="{!! old('room') ?: ((isset($timetable->venue) ? $timetable->venue->name . ' - ' . $timetable->venue->site->name . ', ' . $timetable->venue->site->location->town : '')) !!}">
    </venue-search>
    @include('partials.forms._error', ['field' => 'room_id'])
</div>

<div class="row">
    <div class="col-md-3 spacer-bottom-3x">
        <div class="form-group spacer-bottom-3x">
            {!! Form::label('Start Date') !!}
            <datepicker field-name="start_date" value="{!! isset($timetable->starts_at) ? $timetable->starts_at->format('d/m/Y') : null !!}" min-date="null"/>
            @include('partials.forms._error', [ 'field' => 'start_date' ] )
        </div>
    </div>

    <div class="col-md-3 spacer-bottom-3x">
        <div class="form-group spacer-bottom-3x">
            {!! Form::label('End Date') !!}
            <small>Leave blank if 1 day course</small>
            <datepicker field-name="end_date" value="{!! isset($timetable->starts_at) ? $timetable->starts_at->format('d/m/Y') : null !!}" min-date="null"/>
            @include('partials.forms._error', [ 'field' => 'end_date' ] )
        </div>
    </div>

    <div class="col-md-3 spacer-bottom-3x">
        <div class="form-group spacer-bottom-3x">
            {!! Form::label('Start Time') !!}
            {!! Form::select(
                'start_time',
                dropdownOptions(getTimeByInterval(15)),
                isset($timetable->starts_at) ? $timetable->starts_at->format('H:i') : '',
                ['class' => 'form-control']
            ) !!}
            @include('partials.forms._error', [ 'field' => 'start_time' ] )
        </div>
    </div>

    <div class="col-md-3 spacer-bottom-3x">
        <div class="form-group spacer-bottom-3x">
            {!! Form::label('End Time') !!}
            {!! Form::select(
                'end_time',
                dropdownOptions(getTimeByInterval(15)),
                isset($timetable->ends_at) ? $timetable->ends_at->format('H:i') : '',
                ['class' => 'form-control']
            ) !!}
            @include('partials.forms._error', [ 'field' => 'end_time' ] )
        </div>
    </div>
</div>


{!! Form::submit('Save', ['name' => 'submit', 'class' => 'btn btn-secondary btn-lg']) !!}