@if ($sectors->count() > 0)
	@section('modalContent')
		@foreach ($sectors as $sector)
		<div id="modal{!! $sector->id !!}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		     aria-hidden="true" role="dialog">

			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 class="modal-title" id="myModalLabel">Delete Sector</h3>
					</div>
					<div class="modal-body">
						<p>
						    You are about to {!! $sector->code !!} {!! $sector->name !!} from the database.
							Please confirm if you wish to proceed.
					    </p>
					</div>
					<div class="modal-footer text-left">
						{!! Form::model( $sector, [ 'route' => [ 'sectors.destroy', $sector->id ], 'method' => 'delete' ] ) !!}
						    {!! Form::submit('Delete', array('name' => 'submit', 'class' => 'spacing-top btn btn-lg btn-danger')) !!}
						{!! Form::close() !!}
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		@endforeach
	@stop
@endif