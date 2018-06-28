<template>
    <modals-base v-if="showModal">
        <h3 slot="header">Add Contact</h3>

        <div slot="body">
            <div v-if="errors" class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
            </div>

            <div class="form-group spacer-bottom-3x">
                <text-field label="Name" ref="name" field-name="name" required="true"></text-field>
            </div>

            <div class="form-group spacer-bottom-3x">
                <text-field ref="tel" field-name="tel" label="Telephone"></text-field>
            </div>

            <div class="form-group spacer-bottom-3x">
                <text-field ref="email" field-name="email" label="Email"></text-field>
            </div>

            <div class="form-group spacer-bottom-3x">
                <text-field ref="job_title" field-name="job_title" label="Job Title"></text-field>
            </div>

            <div class="form-group spacer-bottom-3x">
                <buttons-default :is-loading="isLoading" text="Save" @submit="submit"></buttons-default>
            </div>
        </div>
    </modals-base>
</template>

<script>
    export default {
        mixins: [
            require('../../../mixins/Form.vue'),
            require('../../../mixins/Modal.vue')
        ],

        props: ['endpoint', 'organisationId'],

        methods: {
            submit() {
                this.toggleLoadingState()

                this.$http
                    .post(route('api.blink.contacts.store'), {
                        organisation_id: this.organisationId,
                        name: document.getElementById('name').value,
                        tel: document.getElementById('tel').value,
                        email: document.getElementById('email').value,
                        job_title: document.getElementById('job_title').value
                    })
                    .then(() => window.location.reload())
                    .catch(err => {
                        console.log(err.response)
                        this.toggleLoadingState()
                        this.errors = err.response.data
                        this.modalScrollTop()
                    })
            }
        }
    }
</script>