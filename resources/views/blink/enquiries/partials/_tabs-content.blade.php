<div role="tabpanel" class="tab-pane active" id="history">
    <div class="row">
        <div class="col-md-12">
            @if($enquiry->activities->count() > 0)
                @include('blink.enquiries.partials._activities')
            @endif
        </div>
    </div>
</div>

<div role="tabpanel" class="tab-pane" id="opportunities">
    <div class="row">
        <div class="col-md-12">
            @if($enquiry->opportunities->count() > 0)
                @if($enquiry->opportunities->where('deleted_at', null)->count() > 0)
                    <h5 class="text-gray-light text-upper weight-bold spacer-bottom-2x">Live Opportunities</h5>
                    @include('blink.enquiries.partials._opportunities', ['opportunities' => $enquiry->opportunities->where('deleted_at', null)])
                @endif

                @if($enquiry->opportunities->where('deleted_at', '!=', null)->count() > 0)
                    <h5 class="text-gray-light text-upper weight-bold spacer-bottom-2x">Deleted Opportunities</h5>
                    @include('blink.enquiries.partials._opportunities', ['opportunities' => $enquiry->opportunities->where('deleted_at', '!=', null)])
                @endif
            @else
                <p>No opportunities have been submitted for this enquiry.</p>
            @endif
        </div>
    </div>
</div>

<div role="tabpanel" class="tab-pane" id="vacancies">
    <div class="form-group spacer-bottom-3x">
        @if($enquiry->vacancies->count() > 0)
            <div class="spacer-bottom-3x">
                @include('blink.partials._table-vacancies', ['vacancies' => $enquiry->vacancies])
            </div>
        @else
            <p>No vacancies have been submitted for this enquiry</p>
        @endif
    </div>
</div>

<div role="tabpanel" class="tab-pane" id="applicants">
    <div class="row">
        <div class="col-md-12">
            @if($enquiry->applicants->count() > 0)
                @include('blink.partials.identified-starts', ['applicants' => $enquiry->applicants])
            @else
                <p>No applicants have been identified to start for this enquiry.</p>
            @endif
        </div>
    </div>
</div>
