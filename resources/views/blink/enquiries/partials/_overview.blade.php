<ul class="list-group">
    <li class="list-group-item">
        <span class="pull-right">
            @can('updateOwner', $enquiry)
                <blink-enquiry-account-manager-update
                        updated-by="{!! $currentUser->id !!}"
                        url="{!! route('blink.enquiries.owners.store', $enquiry->id) !!}"
                        user="{!! htmlspecialchars(json_encode($enquiry->owners->last()), ENT_QUOTES) !!}">
                </blink-enquiry-account-manager-update>
            @endcan
        </span>
        <strong class="text-gray-dark">Account Manager</strong>

        <ul class="list-unstyled spacer-top">
            <li>
                <i class="fa fa-user fa-fw"></i>
                {!! $enquiry->owners->count() > 0 ? $enquiry->owners->last()->present()->name : config('vandango.blink.enquiries.pending') !!}
            </li>
        </ul>
    </li>

    <li class="list-group-item">
        <span class="pull-right">
            <blink-enquiry-contact-update
                    updated-by="{!! Auth::user()->id !!}"
                    data="{!! htmlspecialchars(json_encode($enquiry), ENT_QUOTES) !!}">
            </blink-enquiry-contact-update>
        </span>
        <strong class="text-gray-dark">Company Contact</strong>
        <ul class="list-unstyled spacer-top">
            <li>
                <i class="fa fa-user fa-fw"></i>
                {!! $enquiry->contact->name !!}
            </li>
            <li>
                <i class="fa fa-phone fa-fw"></i>
                {!! $enquiry->contact->tel !!}
            </li>
            <li>
                <i class="fa fa-envelope fa-fw"></i>
                {!! $enquiry->contact->email !!}
            </li>
        </ul>
    </li>

    <li class="list-group-item">
        <span class="pull-right">
            <blink-enquiry-location-update
                    updated-by="{!! Auth::user()->id !!}"
                    url="{!! route('blink.enquiries.locations.update', $enquiry->id) !!}"
                    location="{!! $enquiry->location !!}">
            </blink-enquiry-location-update>
        </span>
        <strong class="text-gray-dark">Location</strong>
        <ul class="list-unstyled spacer-top">
            <li>
                <i class="fa fa-fw fa-map-marker"></i>
                {!! $enquiry->location !!}
            </li>
        </ul>
    </li>

    <li class="list-group-item">
        <span class="pull-right">
            <blink-enquiry-employee-count-update
                    updated-by="{!! Auth::user()->id !!}"
                    url="{!! route('blink.enquiries.employee-count.update', $enquiry->id) !!}"
                    count="{!! $enquiry->employee_count !!}">
            </blink-enquiry-employee-count-update>
        </span>
        <strong class="text-gray-dark">Employee Count</strong>
        <ul class="list-unstyled spacer-top">
            <li>
                <i class="fa fa-users fa-fw"></i>
                {!! $enquiry->employee_count or 'N/A' !!}
            </li>
        </ul>
    </li>

    @if($currentUser->hasAccess('blinkAdmin'))
        <li class="list-group-item">
        <span class="pull-right">
            <blink-enquiry-campaign-update
                    url="{!! route('blink.enquiries.campaigns.update', $enquiry->id) !!}"
                    campaign-id="{!! $enquiry->campaign_id !!}">
            </blink-enquiry-campaign-update>
        </span>
            <strong class="text-gray-dark">Campaign</strong>
            <ul class="list-unstyled spacer-top">
                <li>
                    <i class="fa fa-fire fa-fw"></i>
                    {!! isset($enquiry->campaign_id) ? $enquiry->campaign->name : 'None' !!}
                </li>
            </ul>
        </li>
    @endif
</ul>