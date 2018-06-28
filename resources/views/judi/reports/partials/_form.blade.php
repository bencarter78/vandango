<div class="form-group spacer-bottom-5x">
    {!! Form::label('Name') !!}
    {!! Form::text('title', isset($report->title) ? $report->title : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'title' ] )
</div>

<div class="form-group spacer-bottom-5x">
    {!! Form::label('Description') !!}
    {!! Form::textarea('description', isset($report->description) ? $report->description : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'description' ] )
</div>

<legend>Linked Criteria</legend>
<judi-criteria-sort
        criteria="{!! htmlspecialchars($criteria->toJson(), ENT_QUOTES, 'UTF-8') !!}"
        report="{!! htmlspecialchars($report->toJson(), ENT_QUOTES, 'UTF-8') !!}">
</judi-criteria-sort>

{!! Form::submit($submit, array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
