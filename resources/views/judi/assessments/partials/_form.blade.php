@if($currentUser->hasAccess( 'judiAdmin' ) || $currentUser->hasAccess('judiPa'))
    <div class="form-group">
        {!! Form::label('Performance Assessor') !!}
        {!! Form::select('assessor_id', dropdownOptions($assessors, 'name'), isset($assessment->assessor_id) ? $assessment->assessor_id : '', array('class' => 'form-control')) !!}
        @include('partials/forms/_error', [ 'field' => 'assessor_id' ])
    </div>
@elseif(isset($assessment))
    {!! Form::hidden('assessor_id', $currentUser->id) !!}
@else
    {!! Form::hidden('assessor_id', $currentUser->id) !!}
@endif

<div class="form-group">
    {!! Form::label('Assessment Date') !!}
    <datepicker field-name="assessment_date" value="{!! isset($assessment->assessment_date) ? $assessment->assessment_date->format('d/m/Y') : '' !!}" min-date="null"></datepicker>
</div>

<div class="form-group">
    {!! Form::label('Reassessment') !!}
    {!! Form::select('is_reassessment', dropdownOptions([0 => 'No', 1 => 'Yes']), isset($assessment->assessor_id) ? $assessment->assessor_id : 0, ['class' => 'form-control' ] ) !!}
    @include('partials/forms/_error', [ 'field' => 'is_reassessment' ] )
</div>

@include('partials.dates._bootstrap-datepicker')
@section('js')
    <script>
        $(function () {
            $(".datetimepicker").datetimepicker({
                format: "DD/MM/YYYY"
            });
        });
    </script>
@stop