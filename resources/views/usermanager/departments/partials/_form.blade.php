<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('department', isset($department->department) ? $department->department : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'department' ] )
</div>

<div class="form-group">
    {!! Form::label('Manager') !!}
    {!! Form::select('manager_id', dropdownOptions($roleManagers, 'name'), isset($department->manager_id) ? $department->manager_id : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'manager_id' ])
</div>

<div class="form-group">
    {!! Form::label('Director') !!}
    {!! Form::select('ad_id', dropdownOptions($roleDirectors, 'name'), isset($department->ad_id) ? $department->ad_id : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'ad_id' ])
</div>