@if(isset($label))
    {!! Form::label($label) !!}
@endif

@if(isset($helpText))
    <p class="{!! isset($helpTextClass) ? $helpTextClass : 'font-size-small' !!}">
        {!! $helpText !!}
    </p>
@endif

{!! Form::select(
    $field,
    dropdownOptions(getTimeByInterval(isset($interval) ? $interval : 15)),
    $value,
    ['class' => 'form-control']
) !!}

@include('partials.forms._error', [ 'field' => $field ] )