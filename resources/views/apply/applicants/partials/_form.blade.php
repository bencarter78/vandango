<div class="spacer-bottom-5x">
    <legend>Qualification</legend>

    <div class="form-group spacer-bottom-3x">
        {!! Form::label('Sector') !!}
        {!! Form::select(
            'sector_id',
            dropdownOptions($sectors, 'title'),
            old('sector_id'),
            ['class' => 'form-control']
        ) !!}
    </div>

    <div class="form-group spacer-bottom-3x">
        {!! Form::label('Qualification Plan') !!}
        {!! Form::select(
            'qualification_plan_id',
            dropdownOptions($qualificationPlans, 'title'),
            old('qualification_plan_id'),
            ['class' => 'form-control']
        ) !!}
    </div>

    <div class="form-group spacer-bottom-3x">
        {!! Form::label('Programme Type') !!}
        {!! Form::select(
            'programme_type',
            dropdownOptions(unemployedProgrammeTypes()),
            old('programme_type'),
            ['class' => 'form-control']
        ) !!}
    </div>

    <div class="form-group spacer-bottom-3x">
        <div class="row">
            <div class="col-md-3">
                <datepicker
                        field-name="starting_on"
                        label="Proposed Start Date"
                        value="{!! old('starting_on') !!}"
                        min-date="">
                </datepicker>
            </div>
        </div>
    </div>
</div>

<div class="spacer-bottom-5x">
    <legend>Identified Learner</legend>

    <div class="form-group spacer-bottom-3x">
        <label>Assigned Training Adviser</label>
        <search-users
                user="{!! $currentUser->present()->name !!}"
                user_id="{!! $currentUser->id !!}"
        ></search-users>
    </div>

    <div class="form-group spacer-bottom-3x">
        {!! Form::label('first_name') !!}
        {!! Form::text(
            'first_name',
            old('first_name'),
            ['class' => 'form-control']
        ) !!}
    </div>

    <div class="form-group spacer-bottom-3x">
        {!! Form::label('surname') !!}
        {!! Form::text(
            'surname',
            old('surname'),
            ['class' => 'form-control']
        ) !!}
    </div>

    <div class="form-group spacer-bottom-3x">
        <div class="row">
            <div class="col-md-3">
                <datepicker
                        field-name="dob"
                        label="Date of Birth"
                        value="{!! old('dob') !!}"
                        min-date="">
                </datepicker>
            </div>
        </div>
    </div>

    <div class="alert alert-info">
        <p>
            <strong><i class="fa fa-warning"></i> Important</strong> <br>
            If you do not know the following information your start will still be logged however, automated pre-sign up
            activities such as BKSB Registration, Skills Scans and Onefile registration will not be able to be
            completed.
            This will make more work for you in the long run and will slow down the process.
        </p>
    </div>

    <div class="form-group spacer-bottom-3x">
        {!! Form::label('email') !!}
        {!! Form::email(
            'email',
            old('email'),
            ['class' => 'form-control']
        ) !!}
    </div>
</div>