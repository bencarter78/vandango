<div id="modal-submit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Submit {!! $title or '' !!}</h3>
            </div>
            <div class="modal-body"><p>{!! $body or '' !!}</p></div>
            <div class="modal-footer text-left">{!! Form::submit('Submit', array('name' => 'submit', 'class' => 'spacing-top btn btn-lg btn-secondary')) !!}</div>
        </div>
    </div>
</div>