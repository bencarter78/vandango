@push('modalContent')
    <div id="modal{!! $model->id !!}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Delete {!! $title or '' !!}</h3>
                </div>
                <div class="modal-body">
                    <p>You are about to delete this from the database. Please confirm if you wish to proceed.</p>
                </div>
                <div class="modal-footer text-left">
                    {!! Form::model( $model, [ 'route' => [ $route, $model->id ], 'method' => 'delete' ] ) !!}
                    {!! Form::submit('Delete', array('name' => 'submit', 'class' => 'spacing-top btn btn-lg btn-danger')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endpush