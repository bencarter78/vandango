<div class="form-group">
    {!! Form::label('Date From') !!}
    <datepicker
            field-name="date_from"
            value="{!! request('date_from', Carbon\Carbon::now()->subMonth()->format('d/m/Y')) !!}"
            min-date="null">
    </datepicker>
</div>

<div class="form-group">
    {!! Form::label('Date To') !!}
    <datepicker
            field-name="date_to"
            value="{!! request('date_to', Carbon\Carbon::now()->subMonth()->format('d/m/Y')) !!}"
            min-date="null">
    </datepicker>
</div>