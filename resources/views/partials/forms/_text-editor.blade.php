@if(isset($label))
    {!! Form::label($label) !!}
@endif

@if(isset($helpText))
    <p class="{!! isset($helpTextClass) ? $helpTextClass : 'font-size-small' !!}">
        {!! $helpText !!}
    </p>
@endif

{!! Form::textarea($field, $value, ['class' => 'form-control tinymce']) !!}
@include('partials/forms/_error', [ 'field' => $field ] )

@include('partials.js._tinymce')