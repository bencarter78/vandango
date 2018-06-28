<div class="form-group">
    <label for="owner">Company Contact</label>
    <blink-contact-search
            endpoint="/api/v1/blink/organisations/{!! $enquiry->contact->organisation->id !!}/contacts"
            contact="{!! htmlspecialchars(json_encode($enquiry->contact, ENT_QUOTES)) !!}">
    </blink-contact-search>
</div>