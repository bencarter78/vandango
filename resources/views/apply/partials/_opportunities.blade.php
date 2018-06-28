<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Organisation</th>
            <th>Expected</th>
            <th class="text-right">Remaining Quantity</th>
            <th class="text-right">Original Total Value</th>
            <th>Submitted By</th>
        </tr>
        </thead>
        <tbody>
        @foreach($opportunities as $opportunity)
            <tr>
                <td>
                    <a href="{!! route('blink.enquiries.edit', $opportunity->enquiry_id) !!}">
                        {{ $opportunity->enquiry->contact->organisation->name }}
                    </a>
                </td>
                <td>{!! $opportunity->expected_on->format('d/m/Y') !!}</td>
                <td class="text-right">
                    {!! $opportunity->quantity - enquiryNamedStartsBySector($opportunity->enquiry, $opportunity->sector_id)->count() !!}
                </td>
                <td class="text-right">{{ $opportunity->formattedValue }}</td>
                <td>{!! $opportunity->submittedBy->fullName !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>