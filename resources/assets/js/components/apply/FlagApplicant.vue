<template>
    <modals-base @modal-close="$emit('modal-close')">
        <h3 slot="header" class="modal-title">Flag Applicant</h3>

        <div slot="body" class="text-left">
            <errors-default v-if="form.errors.any()" :errors="form.errors.all()"></errors-default>
            <p class="spacer-bottom-3x">
                Flag to Adviser that there is a problem with {{ applicant.name }} 's paperwork?
            </p>

            <form-text-area label="Description of the issue" :errors="form.errors" v-model="form.description"/>

            <div v-if="msg" class="alert alert-success">
                <strong>Woohoo!</strong> {{ msg }}
            </div>

            <div class="form-group">
                <buttons-default :is-loading="isLoading" text="Confirm" @submit="submit"></buttons-default>
            </div>
        </div>
    </modals-base>
</template>

<script>
    import Form from './../../forms/form'

    export default {
        mixins: [
            require('./../../mixins/Form.vue'),
            require('./../../mixins/Modal.vue')
        ],
        props: ['applicant', 'userId'],

        data() {
            return {
                isLoading: false,
                msg: '',
                form: new Form({
                    user_id: this.userId,
                    description: ''
                })
            }
        },

        methods: {
            submit() {
                this.isLoading = true

                this.form
                    .post(route('api.apply.applicants.paperwork-issue', this.applicant.id))
                    .then(() => {
                        this.msg = 'Notification dispatched!'
                        setTimeout(() => window.location.reload(), 1000)
                    })
                    .catch(err => {
                        this.isLoading = false
                        console.dir(err)
                    })
            }
        }
    }
</script>
