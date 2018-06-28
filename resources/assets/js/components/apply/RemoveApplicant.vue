<template>
    <modals-base @modal-close="$emit('modal-close')">
        <h3 slot="header" class="modal-title">Remove Applicant</h3>

        <div slot="body" class="text-left">
            <div v-if="removed" class="alert alert-success">
                You have successfully removed the applicant
            </div>

            <p>You are about to remove the following applicant from the named starts on VanDango Apply.</p>

            <ul class="list-unstyled spacer-bottom-3x">
                <li>
                    <strong>Name:</strong> {{ applicant.first_name }} {{ applicant.surname }}
                </li>
                <li>
                    <strong>DOB:</strong> {{ moment(applicant.dob).format('DD/MM/YYYY') }}
                </li>
                <li>
                    <strong>Sector:</strong> {{ applicant.sector.name }}
                </li>
                <li>
                    <strong>Programme:</strong> {{ applicant.programme_type }}
                </li>
            </ul>

            <div class="form-group spacer-bottom-3x">
                <dropdown field-name="withdrawal_id" :options="options" label="Reason For Withdrawal"></dropdown>
            </div>

            <span v-if="! removed" class="btn btn-danger" @click="submit">
                    <span v-if="! isLoading">REMOVE</span>
                    <span v-else>REMOVING...<loaders-clip size="20px" color="#ffffff"></loaders-clip></span>
                </span>
        </div>
    </modals-base>
</template>

<script>
    export default {
        props: {
            applicant: {
                type: Object
            },

            shouldReload: {
                type: Boolean,
                default: true
            }
        },

        data() {
            return {
                errors: null,
                options: [],
                isLoading: false,
                moment: require('moment'),
                removed: false
            }
        },

        created() {
            this.fetchReasons()
        },

        methods: {
            fetchReasons() {
                this.$http
                    .get(route('api.apply.withdrawal'))
                    .then((res) => res.data.data.forEach(o => this.options.push({label: o.name, value: o.id})))
                    .catch(err => console.log(err))
            },

            submit() {
                if (document.getElementById('withdrawal_id').value) {
                    this.isLoading = true
                    this.$http
                        .delete(route('api.apply.applicants.destroy', this.applicant.id), {
                            data: {
                                withdrawal_id: document.getElementById('withdrawal_id').value
                            }
                        })
                        .then(() => {
                            if (this.shouldReload) {
                                window.location.reload()
                            } else {
                                this.$emit('applicant-removed', this.applicant)
                                this.isLoading = false
                                document.getElementsByClassName('modal-container')[0].scrollTop = 0
                                this.removed = true
                            }
                        })
                        .catch(err => this.errors = err.response.data)
                }
            }
        }
    }
</script>
