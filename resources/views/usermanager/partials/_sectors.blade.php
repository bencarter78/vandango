<div class="panel panel-default">
    @include('partials.panels._head', ['title' => 'Sectors'])

    {!! Form::model($user, [ 'route' => [ 'account.update', $user->id ] ]) !!}
    <div class="table-responsive">
        <table class="table table-striped">
            @foreach ($sectors as $sector)
                <tr>
                    <td width="5%">{!! Form::checkbox( 'sector_id[]', $sector->id, checkboxState( $sector->id, $userSectorIds ) ) !!}</td>
                    <td>{!! $sector->name !!} ({!! $sector->code !!})</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="panel-footer">
        <div class="form-actions">
            {!! Form::hidden('ruleset', 'sectors') !!}
            {!! Form::submit('Save', array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>