<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('name', isset($grade->name) ? $grade->name : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'name' ] )
</div>

{!! Form::submit($submit, array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
