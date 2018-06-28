<ul class="list-group">
    <li class="list-group-item">
        <span class="pull-right">
            <blink-organisation-update
                    updated-by="{!! $currentUser->id !!}"
                    url="{!! route('blink.organisations.update', $organisation->id) !!}"
                    organisation="{!! htmlspecialchars(json_encode($organisation), ENT_QUOTES) !!}">
            </blink-organisation-update>
        </span>
        <h4>Details</h4>
    </li>

    <li class="list-group-item">
        <i class="fa fa-fw fa-building-o"></i> {!! $organisation->name !!}
        @if($organisation->alias)
            (aka {!! $organisation->alias !!})
        @endif
    </li>

    <li class="list-group-item">
        <i class="fa fa-fw fa-phone"></i> {!! $organisation->tel or 'N/A'!!}
    </li>

    <li class="list-group-item">
        <i class="fa fa-fw fa-envelope"></i> {!! $organisation->email or 'N/A' !!}
    </li>

    <li class="list-group-item">
        <i class="fa fa-fw fa-globe"></i> {!! $organisation->website or 'N/A' !!}
    </li>

    <li class="list-group-item">
        <i class="fa fa-fw fa-gbp"></i> {!! isset($organisation->levy_pot) ? number_format($organisation->levy_pot) : 'N/A' !!}
    </li>

    <li class="list-group-item">
        <i class="fa fa-fw fa-hashtag"></i> {!! $organisation->datastore_ref or 'N/A' !!}
    </li>
</ul>