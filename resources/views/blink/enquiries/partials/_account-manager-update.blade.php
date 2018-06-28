<label for="owner">Account Manager</label>
<search-users
        user_id="{!! $enquiry->owners->count() > 0 ? $enquiry->owners->last()->id : null !!}"
        user="{!! $enquiry->owners->count() > 0 ? $enquiry->owners->last()->present()->name : config('vandango.blink.enquiries.pending') !!}"
></search-users>