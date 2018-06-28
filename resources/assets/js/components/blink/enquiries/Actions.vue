<template>
    <div>
        <div class="dropdown">
            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-primary">
                Actions
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right" aria-labelledby="dLabel">
                <li v-if="!isCompleted">
                    <span class="is-link" @click="showActivity = true">
                        Add Activity
                    </span>
                </li>
                <li v-if="!isCompleted">
                    <span class="is-link" @click="showOpportunity = true">
                        Add Opportunity
                    </span>
                </li>
                <li v-if="!isCompleted">
                    <a :href="vacancyEndpoint">Add Vacancy</a>
                </li>
                <li v-if="!isCompleted">
                    <span class="is-link" @click="showApplicant = true">
                        Add Applicant
                    </span>
                </li>
                <li>
                    <span class="is-link" @click="showHire = true">
                        Add Hire
                    </span>
                </li>
            </ul>
        </div>

        <div v-if="showActivity">
            <blink-activity-add
                :url="activityEndpoint"
                :statuses="statuses"
                :conclusions="conclusions"
                :updated-by="userId"
                :status-id="statusId"
                @toggle="showActivity = false">
            </blink-activity-add>
        </div>

        <div v-if="showOpportunity">
            <blink-opportunity-add
                :url="opportunityEndpoint"
                :user-id="userId"
                @toggle="showOpportunity = false">
            </blink-opportunity-add>
        </div>

        <modals-base v-if="showApplicant" @modal-close="showApplicant = false">
            <h3 slot="header" class="modal-title">Add Applicant</h3>
            <div slot="body" class="text-left">
                <apply-applicant-form
                    :enquiry-id="enquiry.id"
                    request-method="store"
                    :user-id="userId">
                </apply-applicant-form>
            </div>
        </modals-base>

        <blink-vacancy-hires-add
            v-if="showHire"
            :vacancies="validVacancies"
            :applicants="unhiredApplicants"
            :user-id="userId"
            @modal-close="showHire = false">
        </blink-vacancy-hires-add>
    </div>
</template>

<script>
    export default {
        props: [
            'enquiryData',
            'conclusions',
            'isCompleted',
            'unhiredApplicantsData',
            'statuses',
            'statusId',
            'userId',
        ],

        data() {
            return {
                enquiry: JSON.parse(this.enquiryData),
                showActivity: false,
                showApplicant: false,
                showEnquiry: false,
                showHire: false,
                showOpportunity: false,
                isLoading: false,
            }
        },

        computed: {
            validVacancies() {
                return this.enquiry.vacancies.filter(v => v.ref != null)
            },

            unhiredApplicants() {
                return JSON.parse(this.unhiredApplicantsData).filter(a => a.first_name != '' && a.surname != '')
            },

            activityEndpoint() {
                return route('blink.enquiries.activities.store', this.enquiry.id)
            },

            applicantEndpoint() {
                return route('api.blink.applicants.store')
            },

            opportunityEndpoint() {
                return route('api.blink.opportunities.store', this.enquiry.id)
            },

            vacancyEndpoint() {
                return route('blink.vacancies.create', {id: this.enquiry.id})
            },
        }
    }
</script>

<style scoped>
    .dropdown-menu > li > span.is-link {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: normal;
        line-height: 1.42857143;
        color: #333333;
        white-space: nowrap;
        cursor: pointer;
    }
</style>