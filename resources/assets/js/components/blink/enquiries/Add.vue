<template>
    <div>
        <legend>About The Customer</legend>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group spacer-bottom-3x">
                    <label for="contact_name">
                        Contact Name
                        <span class="text-danger">*</span>
                    </label>
                    <blink-contact-search
                        :contact="contact"
                        endpoint="/api/v1/blink/contacts"
                        v-on:contactSelected="setContact">
                    </blink-contact-search>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group spacer-bottom-3x">
                    <text-field field-name="contact_tel" label="Telephone" :value="contact.tel"></text-field>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group spacer-bottom-3x">
                    <text-field field-name="contact_email" label="Email" :value="contact.email"></text-field>
                </div>
            </div>
        </div>

        <legend>About The Organisation</legend>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group spacer-bottom-3x">
                    <label for="organisation_name">
                        Organisation Name
                        <span class="text-danger">*</span>
                    </label>
                    <blink-organisation-search
                        :organisation="organisation"
                        v-on:organisationSelected="setOrganisation">
                    </blink-organisation-search>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group spacer-bottom-3x">
                    <text-field field-name="organisation_location" label="Area/Town" required="true" placeholder="e.g. Telford, Cheshire, CW10 9LZ, UK, Midlands..." :value="getLocation"></text-field>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group spacer-bottom-3x">
                    <text-field field-name="organisation_size" label="Number of staff organisation employs" :value="organisation.employee_count"></text-field>
                </div>
            </div>
        </div>

        <blink-enquiry-duplicate-check :organisation-id="organisation.id"></blink-enquiry-duplicate-check>

        <legend>About The Enquiry</legend>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group spacer-bottom-3x">
                    <dropdown field-name="referrer_id" label="How did they hear about us?" required="true" :options="referrerOptions" :value="referrerId"></dropdown>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group spacer-bottom-3x">
                    <text-area label="Notes" field-name="note" :value="note" required="true"></text-area>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'contact_id', 'contact_name', 'contact_tel', 'contact_email',
            'organisation_id', 'organisation_name', 'organisation_location', 'organisation_type', 'organisation_size',
            'is_existing', 'referrerId', 'options', 'note'
        ],

        data() {
            return {
                contact: {
                    id: this.contact_id,
                    name: this.contact_name,
                    tel: this.contact_tel,
                    email: this.contact_email
                },

                organisation: {
                    id: this.organisation_id,
                    name: this.organisation_name,
                    location: this.organisation_location,
                    type: this.organisation_type,
                    employee_count: this.organisation_size
                },

                boolOptions: [
                    {value: null, label: 'Please select...'},
                    {value: 1, label: 'Yes'},
                    {value: 0, label: 'No'},
                ],

                referrerOptions: [
                    {value: null, label: 'Please select...'}
                ],
            }
        },

        computed: {
            getLocation() {
                return this.hasLocation()
                    ? this.organisation.locations[0].town
                    : this.organisation.location
            }
        },

        mounted() {
            this.setReferrerOptions(JSON.parse(this.options))
        },

        methods: {
            hasLocation() {
                return this.organisation.locations && this.organisation.locations.length > 0
            },

            setContact(contact) {
                this.contact = contact
                this.setOrganisation(contact.organisation)
            },

            setOrganisation(organisation) {
                this.organisation = organisation
            },

            setReferrerOptions(options) {
                options.forEach(o => {
                    this.referrerOptions.push({
                        value: o.id, label: o.name
                    })
                })
            }
        }
    }
</script>
