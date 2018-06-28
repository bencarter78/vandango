<template>
    <div>
        <a @click="showModal = true" href="#">Unassigned</a>

        <modals-base v-if="showModal">
            <h3 slot="header">Assign Adviser</h3>

            <div slot="body" class="text-left">
                <div class="alert alert-success" v-if="assigned">
                    <strong>Good job!</strong> You have successfully added the identified start. Sending you back...
                </div>

                <form method="post" @submit.prevent="submit">
                    <input type="hidden" name="_token" :value="token">

                    <div class="form-group spacer-bottom-3x">
                        <label>Training Adviser</label>
                        <search-users @itemSelected="adviserSelected"></search-users>
                    </div>

                    <div class="form-group">
                        <input v-if="canAssign" type="submit" class="btn btn-secondary" value="Assign">
                    </div>

                </form>
            </div>
        </modals-base>
    </div>
</template>

<script>
    export default {
        props: ['applicantId'],

        data() {
            return {
                adviser: null,
                assigned: false,
                canAssign: false,
                showModal: false
            }
        },

        methods: {
            submit() {
                this.$http
                    .post(`/api/v1/apply/applicants/${this.applicantId}/assign`, {adviser_id: this.adviser})
                    .then(() => {
                        this.assigned = true
                        window.location.reload()
                    })
                    .catch(err => console.log(err))
            },

            adviserSelected(adviser) {
                this.canAssign = true
                this.adviser = adviser.id
            }
        }
    }
</script>

<style scoped>
    a {
        color: #337ab7;
        text-decoration: underline;
    }
</style>