<div class="tab-content padding-top-3x">
    <div role="tabpanel" class="tab-pane active" id="enquiries">
        @include('blink.partials._enquiry-listing', ['enquiries' => $organisation->allEnquiries])
        </ul>
    </div>

    <div role="tabpanel" class="tab-pane" id="vacancies">
        @if($organisation->vacancies->count() > 0)
            @include('blink.partials._table-vacancies', ['vacancies' => $organisation->vacancies])
        @else
            <p>No vacancies have been recorded for this organisation.</p>
        @endif
    </div>

    <div role="tabpanel" class="tab-pane" id="employees">
        @include('blink.partials._table-contacts', ['contacts' => $organisation->contacts])
    </div>

    <div role="tabpanel" class="tab-pane" id="locations">
        @if($organisation->locations->count() > 0)
            @include('blink.partials._table-locations', ['locations' => $organisation->locations])
        @else
            <p>No locations are recorded for this organisation.</p>
        @endif
    </div>
</div>