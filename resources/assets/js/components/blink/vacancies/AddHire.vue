<template>
    <modals-base @modal-close="$emit('modal-close')">
        <h3 slot="header" class="modal-title">Hire Applicant To Vacancy?</h3>
        <div slot="body" class="text-left">
            <errors-default :errors="form.errors.length"></errors-default>
            <p class="spacer-bottom-3x">
                To make an applicant successful for a vacancy please complete the form below.
            </p>

            <div class="form-group spacer-bottom-3x">
                <form-dropdown
                    v-model="form.vacancy_id"
                    label="Vacancy"
                    field-name="vacancy_id"
                    :options="vacanciesDropdown">
                </form-dropdown>
            </div>

            <div class="form-group spacer-bottom-3x">
                <form-dropdown
                    v-model="form.applicant_id"
                    label="Identified Applicant"
                    field-name="applicant_id"
                    :options="applicantsDropdown">
                </form-dropdown>
            </div>

            <div class="form-group spacer-bottom-3x">
                <label>Vacancy Filled By</label>
                <search-users @itemSelected="form.filled_by = $event.id"></search-users>
            </div>

            <div v-if="showMsg" class="alert alert-success spacer-bottom-3x">
                <p>
                    <i class="fa fa-thumbs-up"></i>
                    You have successfully hired the applicant!
                </p>
            </div>

            <buttons-default :is-loading="isLoading" @submit="submit" text="Hire"></buttons-default>
        </div>
    </modals-base>
</template>

<script>
    import Form from '../../../forms/form'

    export default {
        props: {
            applicants: {
                type: Array,
                default: []
            },
            vacancies: {
                type: Array,
                default: []
            },
            userId: {
                type: String
            }
        },

        data() {
            return {
                isLoading: false,
                showMsg: false,
                form: new Form({
                    applicant_id: '',
                    vacancy_id: '',
                    filled_by: '',
                    user_id: this.userId
                })
            }
        },

        computed: {
            vacanciesDropdown() {
                return this.vacancies.map(v => {
                    return {
                        value: v.id,
                        label: `${v.title} - ${v.sector.title} - NAS Ref: ${v.ref}`
                    }
                })
            },

            applicantsDropdown() {
                return this.applicants.map(a => {
                    return {
                        value: a.id,
                        label: `${a.first_name} ${a.surname}`
                    }
                })
            }
        },

        methods: {
            submit() {
                if (!this.canSubmit()) {
                    return
                }

                this.isLoading = true

                this.form.post(route('api.blink.vacancies.hires.store', this.form.vacancy_id))
                    .then(() => {
                        this.showMsg = true
                        window.location.reload()
                    })
                    .catch(() => {
                        this.isLoading = false
                    })
            },

            canSubmit() {
                return this.form.vacancy_id && this.form.applicant_id && this.form.filled_by
            }
        }
    }
</script>
