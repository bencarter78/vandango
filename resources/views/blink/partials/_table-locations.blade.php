<div class="table-responsive">
    <table class="table">
        <tr>
            <th class="text-center">HQ</th>
            <th>Add 1</th>
            <th>Add 2</th>
            <th>Add 3</th>
            <th>Town</th>
            <th>County</th>
            <th>Post Code</th>
            <th class="text-center">Actions</th>
        </tr>
        @foreach($organisation->locations as $l)
            <tr>
                <td class="text-center">
                    @if($organisation->hq_id === $l->id)
                        <i class="fa fa-map-marker"></i>
                    @endif
                </td>
                <td>{!! $l->add1 !!}</td>
                <td>{!! $l->add2 !!}</td>
                <td>{!! $l->add3 !!}</td>
                <td>{!! $l->town !!}</td>
                <td>{!! $l->county !!}</td>
                <td>{!! $l->postcode !!}</td>
                <td class="text-center">
                    <ul class="list-inline actions">
                        <li>
                            <address-update
                                    endpoint="{!! route('locations.update', $l->id) !!}"
                                    location="{!! htmlspecialchars(json_encode($l), ENT_QUOTES) !!}">
                            </address-update>
                        </li>
                        <li>|</li>
                        <li>
                            <address-remove
                                    endpoint="{!! route('locations.destroy', $l->id) !!}"
                                    location="{!! htmlspecialchars(json_encode($l), ENT_QUOTES) !!}">
                            </address-remove>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>
</div>