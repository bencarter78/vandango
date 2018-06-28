<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#enquiries" aria-controls="enquiries" role="tab" data-toggle="tab">
            Enquiries
            @if($organisation->allEnquiries->count() > 0)
                <span class="badge badge-primary">{!! $organisation->allEnquiries->count() !!}</span>
            @endif
        </a>
    </li>
    <li role="presentation">
        <a href="#vacancies" aria-controls="vacancies" role="tab" data-toggle="tab">
            Vacancies
            @if($organisation->vacancies->count() > 0)
                <span class="badge badge-primary">{!! $organisation->vacancies->count() !!}</span>
            @endif
        </a>
    </li>
    <li role="presentation">
        <a href="#employees" aria-controls="contacts" role="tab" data-toggle="tab">
            Contacts
            @if($organisation->contacts->count() > 0)
                <span class="badge badge-primary">{!! $organisation->contacts->count() !!}</span>
            @endif
        </a>
    </li>
    <li role="presentation">
        <a href="#locations" aria-controls="locations" role="tab" data-toggle="tab">
            Locations
            @if($organisation->locations->count() > 0)
                <span class="badge badge-primary">{!! $organisation->locations->count() !!}</span>
            @endif
        </a>
    </li>
    <li role="presentation" class="pull-right">
        <blink-organisation-actions
                contact-endpoint="{!! route('blink.contacts.create') !!}"
                enquiry-endpoint="{!! route('blink.enquiries.create') !!}"
                location-endpoint="{!! route('blink.organisations.locations.store', $organisation->id) !!}"
                organisation-id="{!! $organisation->id !!}">
        </blink-organisation-actions>
    </li>
</ul>