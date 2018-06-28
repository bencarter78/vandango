<div class="form-group">
    {!! Form::label('Code') !!}
    {!! Form::text('code', isset($sector->code) ? $sector->code : '', array('class' => 'form-control')) !!}
    @include('partials.forms/_error', [ 'field' => 'code' ] )
</div>

<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('name', isset($sector->name) ? $sector->name : '', array('class' => 'form-control')) !!}
    @include('partials.forms/_error', [ 'field' => 'name' ] )
</div>

<div class="form-group">
    {!! Form::label('Linked Department') !!}
    {!! Form::select('department_id', dropdownOptions($departments, 'department'), isset($sector->department_id) ? $sector->department_id : '', array('class' => 'form-control')) !!}
    @include('partials.forms/_error', [ 'field' => 'department_id' ])
</div>