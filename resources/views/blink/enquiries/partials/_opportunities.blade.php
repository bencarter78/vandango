<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Sector</th>
            <th>Programme</th>
            <th>Expected</th>
            <th>Submitted By</th>
            <th class="text-right">Quantity</th>
            <th class="text-right">Value</th>
            @if($currentUser->hasAccess('blinkAdmin') && $opportunities->first()->deleted_at === null)
                <th class="text-center">Actions</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($opportunities as $opportunity)
            <tr>
                <td>{!! $opportunity->sector->title !!}</td>
                <td>{!! $opportunity->programme_type !!}</td>
                <td>{!! $opportunity->expected_on->format('d/m/Y') !!}</td>
                <td>{!! $opportunity->submittedBy->fullName !!}</td>
                <td class=text-right>{!! $opportunity->quantity !!}</td>
                <td class=text-right>{!! $opportunity->formattedValue !!}</td>
                @if($currentUser->hasAccess('blinkAdmin') && $opportunities->first()->deleted_at === null)
                    <td class="text-center">
                        <ul class="actions list-inline">
                            <li>
                                <actions-delete
                                        uri="{!! route('api.blink.opportunities.destroy', [$opportunity->enquiry_id, $opportunity->id]) !!}"
                                        user-id="{!! $currentUser->id !!}">
                                </actions-delete>
                            </li>
                        </ul>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>TOTAL</th>
            <th></th>
            <th></th>
            <th></th>
            <th class="text-right">{!! number_format($opportunities->sum->quantity) !!}</th>
            <th class="text-right">
                £{!! number_format($opportunities->sum->value) !!}</th>
            <th></th>
        </tr>
        </tfoot>
    </table>
</div>