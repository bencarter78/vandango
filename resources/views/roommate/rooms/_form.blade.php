<div class="form-group spacer-bottom-3x">
    @include('partials.forms._text', ['label' => 'Name', 'field' => 'name', 'value' => isset($room) ? $room->name : null])
</div>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._select', ['label' => 'Site', 'field' => 'site_id', 'value' => isset($room) ? $room->site_id : null, 'options' => dropdownOptions($sites, 'name')])
</div>

<div class="form-group spacer-bottom-3x">
    @include('partials.forms._text', ['label' => 'Max Capacity', 'field' => 'capacity', 'value' => isset($room) ? $room->capacity : null])
</div>

<div class="spacer-top-3x">
    {!! Form::submit('Save', ['name' => 'submit', 'class' => 'btn btn-secondary btn-lg']) !!}
</div>