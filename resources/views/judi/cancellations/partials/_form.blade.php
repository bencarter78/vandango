<div class="form-group">
    {!! Form::label('Type') !!}
    {!! Form::text('type', isset($cancellation->type) ? $cancellation->type : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'type' ] )
</div>

{!! Form::submit($submit, array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
