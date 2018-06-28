<div class="table-responsive">
    <table class="table">
        <tr>
            <th>Status</th>
            <th>Contact</th>
            <th>Owner</th>
            <th>Initial Note</th>
            <th>Enquired</th>
            <th class="text-center">Actions</th>
        </tr>
        @foreach($enquiries as $enquiry)
            <tr>
                <td>{!! $enquiry->statuses->last()->name !!}</td>
                <td>{!! $enquiry->contact->name !!}</td>
                <td>{!! $enquiry->owners->count() > 0 ? $enquiry->owners->last()->present()->name : 'N/A' !!}</td>
                <td>{!! $enquiry->activities->count() > 0 ? $enquiry->activities->first()->note : 'N/A' !!}</td>
                <td>{!! $enquiry->created_at->format('d/m/Y') !!}</td>
                <td class="text-center">
                    <small class="text-upper">
                        <a href="{!! route('blink.enquiries.edit', $enquiry->id) !!}" class="is-link">
                            View
                        </a>
                    </small>
                </td>
            </tr>
        @endforeach
    </table>
</div>