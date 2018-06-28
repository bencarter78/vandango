{!! csrf_field() !!}

<legend>
    <small class="pull-right">
        <a href="{!! route('blink.enquiries.edit', $enquiry->id) !!}" class="is-link font-size-smallest text-upper">
            View enquiry
        </a>
    </small>
    {!! $enquiry->contact->organisation->name !!}
</legend>

<div class="form-group spacer-bottom-3x">
    <label for="contact_id">Company Contact</label>
    @if($contacts->count() === 0)
        <div class="alert alert-danger">
            <i class="fa fa-warning"></i>
            All vacancies require a company contact to have both an email address and a contact telephone number
            recorded. This organisation does not a contact recorded with both of these. You need to update or add a new
            contact
            <a href="{!! route('blink.organisations.show', $enquiry->contact->organisation_id) !!}" class="is-underlined">here</a>
            before you submit this vacancy.
        </div>
    @else
        <div class="alert alert-info">
            <i class="fa fa-info-circle"></i>
            This field will only display contacts that have both an email address and contact telephone number.
            To update an existing contact or add a new one, click
            <a href="{!! route('blink.organisations.show', $enquiry->contact->organisation_id) !!}" class="is-underlined">here</a>.
        </div>
        @include('partials.forms._select', [
            'field' => 'contact_id',
            'options' => dropdownOptions($contacts, 'name'),
            'value' => old('contact_id', isset($vacancy) ? $vacancy->contact_id : null)
        ])
    @endif
</div>

<div class="form-group spacer-bottom-3x">
    @if($enquiry->contact->organisation->locations->count() === 0)
        <label>Location</label>
        <div class="alert alert-danger">
            <i class="fa fa-warning"></i>
            This organisation has no locations recorded. Please enter a location
            <a href="{!! route('blink.organisations.show', $enquiry->contact->organisation_id) !!}" class="is-underlined">here</a>
            before you submit this vacancy.
        </div>
    @else
        @include('partials.forms._select', [
            'field' => 'location_id',
            'label' => 'Location',
            'options' => dropdownOptions($enquiry->contact->organisation->locations, 'address'),
            'value' => old('location_id', isset($vacancy) ? $vacancy->location_id : null)
        ])
    @endif
</div>

<div class="form-group spacer-bottom-3x">
    <text-editor
            field-name="organisation_description"
            help-text="Please give a good description of the organisation, a good starting place might be the organisation's website 'About Us' page (if they have one)."
            label="Organisation Description"
            value="{{{ old('organisation_description', isset($vacancy) ? $vacancy->organisation_description : null) }}} ">
    </text-editor>
    @include('partials/forms/_error', [ 'field' => 'organisation_description' ] )
</div>

<legend>Employment</legend>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._text', [
        'field' => 'title',
        'label' => 'Job Title',
        'value' => old('title', isset($vacancy) ? $vacancy->title : null)
    ])
</div>

<div class="form-group spacer-bottom-3x">
    <text-editor
            field-name="description"
            label="Job Description"
            help-text="Please provide a short introduction to your vacancy and up to 5 daily duties. Without this information there will be a delay in your vacancy going on to the National Apprenticeship Service."
            value="{{{ old('description', isset($vacancy) ? $vacancy->description : '<p>The company are looking to recruit an apprentice to join their team...</p><p>Daily duties may include but are not limited to:</p><p>[Please list 5 daily duties]</p><p>[Please add any further information].</p>') }}}">
    </text-editor>
    @include('partials/forms/_error', [ 'field' => 'description' ] )
</div>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._text', [
        'field' => 'wage',
        'label' => 'Wage',
        'helpText' => 'Please enter only a whole number or decimal (no characters such as £)',
        'value' => old('wage', isset($vacancy) ? $vacancy->wage : null)
    ])
</div>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._text', [
        'field' => 'hours',
        'helpText' => 'Please enter the total number of hours required per week (whole number)',
        'label' => 'Total Hours',
        'value' => old('hours', isset($vacancy) ? $vacancy->hours : null)
    ])
</div>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._text', [
        'field' => 'working_week',
        'helpText' => 'Please enter a description of the working week, e.g. Monday - Friday 9am - 5pm',
        'label' => 'Working Week',
        'value' => old('working_week', isset($vacancy) ? $vacancy->working_week : null)
    ])
</div>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._text', [
        'field' => 'positions_count',
        'label' => 'Number of positions available',
        'helpText' => 'Please enter a whole number',
        'value' => old('positions_count', isset($vacancy) ? $vacancy->positions_count : null)
    ])
</div>

<legend>Qualification</legend>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._select', [
        'field' => 'sector_id',
        'label' => 'Sector',
        'options' => dropdownOptions($sectors, 'title'),
        'value' => old('sector_id', isset($vacancy) ? $vacancy->sector_id : null)
    ])
</div>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._select', [
        'field' => 'framework_id',
        'label' => 'Framework',
        'options' => dropdownOptions($frameworks, 'name'),
        'value' => old('framework_id', isset($vacancy) ? $vacancy->framework_id : null)
    ])
</div>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._select', [
        'field' => 'qual_type',
        'label' => 'Qualification Type',
        'options' => dropdownOptions(['Apprenticeship', 'Traineeship']),
        'value' => old('qual_type', isset($vacancy) ? $vacancy->qual_type : null)
    ])
</div>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._select', [
        'field' => 'level_id',
        'label' => 'Level',
        'options' => dropdownOptions($levels, 'name'),
        'value' => old('level_id', isset($vacancy) ? $vacancy->level_id : null)
    ])
</div>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._text', [
        'field' => 'duration',
        'helpText' => 'Please enter the total number of months the qualification will take (whole number)',
        'label' => 'Duration',
        'value' => old('duration', isset($vacancy) ? $vacancy->duration : null)
    ])
</div>


<legend>Dates</legend>

<div class="row">
    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._datepicker', [
                'field' => 'closes_on',
                'label' => 'Closing Date',
                'value' => old('closes_on', isset($vacancy->closes_on) ? $vacancy->closes_on->format('d/m/Y') : null)
            ])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._datepicker', [
                'field' => 'interviews_on',
                'label' => 'Approx. Interview Date',
                'value' => old('interviews_on', isset($vacancy->interviews_on) ? $vacancy->interviews_on->format('d/m/Y') : null)
            ])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._datepicker', [
                'field' => 'starts_on',
                'label' => 'Approx Start Date',
                'value' => old('starts_on', isset($vacancy->starts_on) ? $vacancy->starts_on->format('d/m/Y') : null)
            ])
        </div>
    </div>
</div>

<legend>Requirements</legend>

<div class="form-group spacer-bottom-3x">
    <text-editor
            field-name="required_skills"
            label="Required Skills"
            value="{{{ old('required_skills', isset($vacancy) ? $vacancy->required_skills : null) }}}">
    </text-editor>
    @include('partials/forms/_error', [ 'field' => 'required_skills' ] )
</div>

<div class="form-group spacer-bottom-3x">
    <text-editor
            field-name="required_qualifications"
            label="Required Qualifications"
            value="{{{ old('required_qualifications', isset($vacancy) ? $vacancy->required_qualifications : null) }}}">
    </text-editor>
    @include('partials/forms/_error', [ 'field' => 'required_qualifications' ] )
</div>

<div class="form-group spacer-bottom-3x">
    <text-editor
            field-name="personal_qualities"
            label="Personal Qualities"
            value="{{{ old('personal_qualities', isset($vacancy) ? $vacancy->personal_qualities : null) }}}">
    </text-editor>
    @include('partials/forms/_error', [ 'field' => 'personal_qualities' ] )
</div>

<div class="form-group spacer-bottom-3x">
    <text-editor
            field-name="training_provided"
            help-text="Please include the exact qualification that the successful applicant will be doing including functional skills & levels and any further training."
            label="Training Provided"
            value="{{{ old('training_provided', isset($vacancy) ? $vacancy->training_provided : null) }}}">
    </text-editor>
    @include('partials/forms/_error', [ 'field' => 'training_provided' ] )
</div>

<div class="form-group spacer-bottom-3x">
    <text-editor
            field-name="future_prospects"
            label="Future Prospects"
            value="{{{ old('future_prospects', isset($vacancy) ? $vacancy->future_prospects : null) }}}">
    </text-editor>
    @include('partials/forms/_error', [ 'field' => 'future_prospects' ] )
</div>

<div class="form-group spacer-bottom-3x">
    <text-editor
            field-name="considerations"
            label="Considerations"
            value="{{{ old('considerations', isset($vacancy) ? $vacancy->considerations : null) }}}">
    </text-editor>
    @include('partials/forms/_error', [ 'field' => 'considerations' ] )
</div>


<legend>Questions To Ask The Applicants</legend>

<div class="form-group spacer-bottom-3x">
    <div class="spacer-bottom-3x">
        <div class="input-group">
            <div class="input-group-addon">1</div>
            @include('partials.forms._text', [
                'field' => 'question_1',
                'value' => old('question_1', isset($vacancy) ? $vacancy->question_1 : 'What appeals to you about this Apprenticeship?')
            ])
        </div>
    </div>

    <div class="input-group">
        <div class="input-group-addon">2</div>
        @include('partials.forms._text', [
            'field' => 'question_2',
            'value' => old('question_2', isset($vacancy) ? $vacancy->question_2 : 'How will you travel to work? If you live further than 15 miles away from the location of this vacancy, please tell us precisely how you intend to travel to and from work?')
        ])
    </div>
</div>

<legend>Instructions</legend>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._select', [
        'field' => 'is_visible',
        'helpText' => 'In some cases, the employer may wish to be remain anonymous. If so, please select "No".',
        'label' => 'Show Company',
        'options' => dropdownOptions(boolOptions(), null, 'id', []),
        'value' => old('is_visible', isset($vacancy) ? $vacancy->is_visible : null)
    ])
</div>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._text', [
        'field' => 'application_route_url',
        'helpText' => 'If the organisation would like to use a different way to apply other than on the National Apprenticeship Service, please enter a valid web address to where applicants should apply.',
        'label' => 'Application Route',
        'value' => old('application_route_url', isset($vacancy) ? $vacancy->application_route_url : null)
    ])
</div>

<div class="form-group spacer-bottom-3x">
    <label>Application Manager:</label>
    <p class="spacer-top-1x font-size-small">
        If applications should not go to the company contact as indicated above, enter the name of the person
        applications should be sent to.
    </p>
    <search-users
            user="{!! repopulateAutocomplete(old('search')['user_id'], isset($vacancy) && $vacancy->applicationManager ? $vacancy->applicationManager->fullName : null ) !!}"
            user_id="{!! old('user_id', isset($vacancy) ? $vacancy->application_manager_id : '') !!}">
    </search-users>
</div>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._select', [
        'field' => 'filter_applications',
        'helpText' => 'Should the Application Manager filter the applications before sending to the company contact?',
        'label' => 'Filter Applications',
        'options' => dropdownOptions(boolOptions()),
        'value' => old('filter_applications', isset($vacancy) ? $vacancy->filter_applications : null)
    ])
</div>

<div class="row">
    <div class="col-md-6">
        <div class="spacer-bottom-3x">
            <input type="submit" name="save" value="Save" class="btn btn-default btn-lg"/>
        </div>
    </div>

    <div class="col-md-6">
        <div class="spacer-bottom-3x text-right">
            <input type="submit" name="submit" value="Submit" class="btn btn-secondary btn-lg"/>
        </div>
    </div>
</div>