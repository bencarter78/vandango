@if(isset($label))
    {!! Form::label($label) !!}
@endif

{!! Form::password($field, ['class' => 'form-control']) !!}
@include('partials/forms/_error', [ 'field' => $field ] )