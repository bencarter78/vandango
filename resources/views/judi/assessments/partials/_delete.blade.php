@if( $assessments->count() > 0 )
@section('modalContent')
    @foreach ($assessments as $assessment)
        <div id="modal{!! $assessment->id !!}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Delete Assessment</h3>
                    </div>
                    <div class="modal-body">
                        <p>You are about to delete this from the database. Please confirm if you wish to proceed.</p>
                    </div>
                    <div class="modal-footer text-left">
                        {!! Form::model( $assessment, [ 'route' => [ 'judi.assessments.destroy', $assessment->id ], 'method' => 'delete' ] ) !!}
                        <div class="form-group">
                            {!! Form::label('Reason for deleting assessment') !!}
                            {!! Form::select('cancellation_id', dropdownOptions($cancellationReasons, 'type'), isset($assessment->cancellation_id) ? $assessment->cancellation_id : '', array('class' => 'form-control')) !!}
                            @include('partials/forms/_error', [ 'field' => 'cancellation_id' ])
                        </div>
                        {!! Form::hidden('ruleset', 'destroy') !!}
                        {!! Form::submit('Delete', array('name' => 'submit', 'class' => 'spacing-top btn btn-lg btn-danger')) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop
@endif