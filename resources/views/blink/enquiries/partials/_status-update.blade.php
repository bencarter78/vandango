<li class="list-group-item">
    <label for="owner">Organisation</label>
    <blink-contact-search
            endpoint="/api/v1/blink/organisations/{!! $enquiry->contact->organisation->id !!}/contacts"
            contact="{!! htmlspecialchars(json_encode($enquiry->contact, ENT_QUOTES)) !!}">
    </blink-contact-search>
    <label>Location</label>
    <dropdown fieldName="tel" value="{!! $enquiry->contact->tel !!}"></dropdown>
</li>

<li class="list-group-item">
    <label for="status_id">Status</label>
    <select name="status_id" class="form-control">
        <option value="">Please select...</option>

        <optgroup label="Live Statuses">
            @foreach($liveStatuses as $status)
                <option value="{!! $status->id !!}" {!! isSelected($enquiry->statuses->last()->id, $status->id) !!}>
                    {!! $status->name !!}
                </option>
            @endforeach
        </optgroup>

        <optgroup label="Completed Statuses">
            @foreach($completedStatuses as $status)
                <option value="{!! $status->id !!}" {!! isSelected($enquiry->statuses->last()->id, $status->id) !!}>
                    {!! $status->name !!}
                </option>
            @endforeach
        </optgroup>
    </select>
    @include('partials/forms/_error', ['field' => 'status_id'])
</li>