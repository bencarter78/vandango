<div class="form-group spacer-bottom-3x">
    @include('partials.forms._text', ['label' => 'Name', 'field' => 'name', 'value' => isset($site) ? $site->name : null])
</div>

<legend>Address</legend>
@include('partials.forms._address', ['location' => isset($site) ? $site->location : null])

<div class="row">
    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._text', ['label' => 'Tel', 'field' => 'tel', 'value' => isset($site) ? $site->tel : null])
        </div>
    </div>
</div>

<legend>Information</legend>
<div class="row">
    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._select', [
                'label' => 'Total People Owned',
                'field' => 'is_owned',
                'value' => isset($site) ? $site->is_owned : null,
                'options' => dropdownOptions(boolOptions())
            ])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._select', [
                'label' => 'Disabled Access',
                'field' => 'has_disabled_access',
                'value' => isset($site) ? $site->has_disabled_access : null,
                'options' => dropdownOptions(boolOptions())
            ])
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._time', ['label' => 'Opens At', 'field' => 'opens_at', 'value' => isset($site) ? $site->opens_at->format('H:i') : null])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            @include('partials.forms._time', ['label' => 'Closes At', 'field' => 'closes_at', 'value' => isset($site) ? $site->closes_at->format('H:i') : null])
        </div>
    </div>
</div>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._textarea', ['label' => 'Parking', 'field' => 'parking', 'value' => isset($site) ? $site->parking : null])
</div>

<div class="spacer-top-3x">
    {!! Form::submit('Save', ['name' => 'submit', 'class' => 'btn btn-secondary btn-lg']) !!}
</div>