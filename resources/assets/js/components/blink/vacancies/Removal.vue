<template>
    <div>
        <button class="btn btn-block btn-danger text-upper" @click="toggleModal">
            Delete/Close
        </button>

        <modals-base v-if="showModal">
            <h3 slot="header" class="modal-title">Delete/Close Vacancy</h3>

            <div slot="body">
                <form @submit.prevent="submit" method="post">
                    <p v-if="! isDraft">
                        By deleting/closing this vacancy, the Recruitment & Engagement team will be notified and if applicable,
                        your vacancy will be removed from the National Apprenticeship Service and all applicants will
                        be notified that the vacancy has been withdrawn.
                    </p>

                    <p class="spacer-bottom-3x">Are you sure you want to delete/close this vacancy?</p>

                    <buttons-default
                        :is-loading="isLoading"
                        classes="btn-danger"
                        text="Delete"
                        @submit="submit">
                    </buttons-default>
                </form>
            </div>
        </modals-base>
    </div>
</template>

<script>
    export default {
        mixins: [
            require('../../../mixins/Form.vue'),
            require('../../../mixins/Modal.vue')
        ],

        props: ['vacancyId', 'isDraft', 'userId', 'previousUrl'],

        data() {
            return {
                showModal: false
            }
        },

        methods: {
            submit() {
                this.toggleLoadingState()
                this.$http({
                    method: 'delete',
                    url: '/api/v1/blink/vacancies/' + this.vacancyId,
                    data: {user_id: this.userId}
                })
                    .then(res => window.location.href = this.previousUrl)
                    .catch(err => {
                        console.log(err.data)
                        this.toggleLoadingState()
                    })
            }
        }
    }
</script>