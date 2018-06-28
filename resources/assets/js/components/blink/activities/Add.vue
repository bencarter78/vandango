<template>
    <modals-base v-if="showModal">
        <h3 slot="header" class="modal-title">Add Activity</h3>

        <div slot="body">
            <form :action="url" method="post">
                <input type="hidden" name="_token" :value="token">
                <input type="hidden" name="updated_by" :value="updatedBy">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group spacer-bottom-3x">
                            <datepicker field-name="due_at" label="Activity Date" :maxDate="maxDate" minDate="null"></datepicker>
                        </div>

                        <div class="form-group spacer-bottom-3x">
                            <dropdown
                                label="Status"
                                field-name="status_id"
                                :value="statusId"
                                @has-updated="status = $event"
                                :options="options.statuses">
                            </dropdown>
                        </div>

                        <transition name="fade">
                            <div class="form-group spacer-bottom-3x" v-if="isClosing">
                                <dropdown
                                    label="Outcome"
                                    field-name="conclusion_id"
                                    :options="options.conclusions">
                                </dropdown>


                                <div class="alert alert-info spacer-bottom-3x spacer-top-3x">
                                    <i class="fa fa-warning"></i> <strong>Important!</strong> <br/>
                                    Closing this enquiry will mark all opportunities and vacancies as closed.
                                    Any live vacancies will be withdrawn from the National Apprenticeship Service and
                                    applicants will be informed the vacancy has been withdrawn.
                                </div>
                            </div>
                        </transition>

                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Save</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group spacer-bottom-3x">
                            <text-area label="Notes" field-name="note"></text-area>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </modals-base>
</template>

<script>
    var moment = require("moment")

    export default {
        props: ["conclusions", "url", "updatedBy", "statuses", "statusId"],

        data() {
            return {
                showModal: true,
                items: {},
                token: document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                endpoint: "/api/v1/blink/contacts",
                maxDate: moment().toDate(),
                status: "",
                options: {
                    statuses: [],
                    conclusions: [{value: "", label: "Please select"}]
                }
            }
        },

        watch: {
            showModal() {
                this.$emit("toggle")
            }
        },

        computed: {
            isClosing() {
                return this.status == "23"
            }
        },

        mounted() {
            JSON.parse(this.statuses).forEach(o => {
                this.options.statuses.push({
                    label: o.name,
                    value: o.id
                })
            })

            JSON.parse(this.conclusions).forEach(o => {
                this.options.conclusions.push({
                    label: o.name,
                    value: o.id
                })
            })
        },

        methods: {
            toggleModal() {
                this.showModal = !this.showModal
            }
        }
    }
</script>

<style scoped>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s;
    }

    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }
</style>