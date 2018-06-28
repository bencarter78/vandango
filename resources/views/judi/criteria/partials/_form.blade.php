<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('name', isset($criteria->name) ? $criteria->name : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'name' ] )
</div>

<div class="form-group">
    {!! Form::label('Description / Help Text') !!}
    {!! Form::textarea('description', isset($criteria->description) ? $criteria->description : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'description' ] )
</div>


{!! Form::submit($submit, array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
