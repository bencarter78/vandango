<template>
    <div>
        <a class="btn btn-success btn-block text-upper spacer-bottom-1x" @click="setIntent('approve')">Approve</a>
        <a class="btn btn-warning btn-block text-upper" @click="setIntent('reject')">Reject</a>

        <modals-base v-if="showModal">
            <h3 slot="header">{{ intent.charAt(0).toUpperCase() + intent.slice(1) }} Vacancy</h3>
            <div slot="body">
                <p>Are you sure you want to {{ intent }} the vacancy?</p>
                <form :action="action" method="post" class="spacer-top-3x">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="_token" :value="token">
                    <div v-if="intent === 'approve'">
                        <input class="btn btn-success text-upper" type="submit" name="approve" value="Approve"/>
                    </div>
                    <div v-else>
                        <text-area label="Reason For Rejecting" fieldName="reason" @input-update="disabled"></text-area>
                        <input class="btn btn-danger text-upper" type="submit" name="reject" value="Reject" v-if="canSubmit"/>
                    </div>
                </form>
            </div>
        </modals-base>
    </div>
</template>

<script>
    export default {
        props: ['action', 'vacancy'],

        data() {
            return {
                token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                showModal: false,
                canSubmit: false,
                intent: ''
            }
        },

        methods: {
            setIntent(intent) {
                this.showModal = true
                this.intent = intent
            },

            disabled(e) {
                if (e.target.value.length > 4) {
                    this.canSubmit = true
                }
            }
        }
    }
</script>