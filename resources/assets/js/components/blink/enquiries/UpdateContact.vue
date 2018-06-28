<template>
    <div>
        <span @click="toggleModal">
            <i class="fa fa-pencil"></i>
        </span>

        <modals-base v-if="showModal">
            <h3 slot="header">Update Company Contact</h3>

            <div slot="body">
                <errors-default :errors="errors"></errors-default>

                <div class="form-group spacer-bottom-3x">
                    <label for="contact_name">Contact Name</label>
                    <blink-contact-search
                        :contact="contact"
                        endpoint="/api/v1/blink/contacts"
                        @contactSelected="setContact">
                    </blink-contact-search>
                </div>

                <div class="form-group spacer-bottom-3x">
                    <text-field fieldName="contact_tel" label="Telephone" :value="contact.tel"></text-field>
                </div>

                <div class="form-group spacer-bottom-3x">
                    <text-field fieldName="contact_email" label="Email" :value="contact.email"></text-field>
                </div>

                <div class="form-group spacer-bottom-3x">
                    <buttons-default :isLoading="isLoading" text="Save" @submit="submit"></buttons-default>
                </div>
            </div>
        </modals-base>
    </div>
</template>

<script>
    export default {
        mixins: [require('../../../mixins/Modal')],
        props: ['data', 'updatedBy'],

        data() {
            return {
                contact: '',
                enquiry: '',
                errors: null,
                isLoading: false,
                item: {},
                showModal: false
            }
        },

        mounted() {
            this.enquiry = JSON.parse(this.data)
            this.contact = this.enquiry.contact
            this.contact.name = [this.contact.first_name, this.contact.surname].join(' ')
        },

        methods: {
            submit() {
                this.isLoading = true
                this.$http
                    .put(route('api.blink.enquiries.contacts.update', this.enquiry.id), this.formData())
                    .then(() => window.location.reload())
                    .catch(err => {
                        this.errors = err.response.data
                    })
                this.isLoading = false
            },

            formData() {
                return {
                    id: document.getElementsByName('contact_id')[0].value,
                    name: document.getElementsByName('search[contact_id]')[0].value,
                    tel: document.getElementsByName('contact_tel')[0].value,
                    email: document.getElementsByName('contact_email')[0].value,
                    organisation_id: document.getElementsByName('contact_id')[0].value != ''
                        ? this.contact.organisation_id
                        : this.enquiry.contact.organisation_id
                }
            },

            setContact(contact) {
                this.contact = contact
            }
        }
    }
</script>