<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>All Identified Applicants</h4>
        </div>

        <div v-if="loading">
            <spinner :loading="loading"></spinner>
        </div>

        <div class="table-responsive" v-else>
            <div class="form-group spacer-bottom-2x">
                <input class="form-control" v-model="search" placeholder="Filter applicant, sector, adviser...">
            </div>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Applicant</th>
                    <th>IDENT</th>
                    <th>DOB</th>
                    <th>Type</th>
                    <th>Sector</th>
                    <th>Start Due</th>
                    <th>Adviser</th>
                    <th>Submitted By</th>
                    <th class="text-center">Enquiry</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(app, index) in filteredData" :class="{ danger: hasMatchingIdent(app, index, filteredData), warning: hasMatchingName(app, index, filteredData) }">
                    <td>{{ app.firstName }} {{ app.surname }}</td>
                    <td>{{ app.ident }}</td>
                    <td>{{ app.dob }}</td>
                    <td>
                        {{ app.type }}
                        <small v-if="app.qualPlan != ''">
                            <br>{{ app.qualPlan }}
                        </small>
                    </td>
                    <td>{{ app.sector }}</td>
                    <td>{{ app.startingOn }}</td>
                    <td>{{ app.adviser }}</td>
                    <td>{{ app.submittedBy }}</td>
                    <td class="text-center">
                        <a v-if="app.enquiry_id" class="is-link text-upper font-size-small" :href="enquiryUrl(app.enquiry_id)">View</a>
                    </td>
                    <td class="text-center">
                        <ul class="list-inline actions">
                            <li>
                                <small class="is-link" @click="editApplicant(app)">EDIT</small>
                            </li>
                            <li>
                                <small class="text-gray-lighter">|</small>
                            </li>
                            <li>
                                <small class="is-link" @click="removeApplicant(app)">REMOVE</small>
                            </li>
                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <modals-base v-if="showEditApplicantModal" @modal-close="showEditApplicantModal = false">
            <h3 slot="header" class="modal-title">Edit Applicant</h3>
            <div slot="body" class="text-left">
                <apply-applicant-form
                    :canPicsMatch="true"
                    :applicant="selectedApplicant"
                    :should-reload="false"
                    request-method="update"
                    @applicant-updated="updateApplicant"/>
            </div>
        </modals-base>

        <apply-applicant-remove
            v-if="showRemoveApplicantModal"
            :applicant="selectedApplicant"
            :should-reload="false"
            @applicant-removed="hideApplicant"
            @modal-close="showRemoveApplicantModal = false"/>
    </div>
</template>

<script>
    const moment = require('moment')

    export default {
        mixins: [require('./../../mixins/usermanager/Sector')],
        props: ['hasAccess', 'userId'],

        data() {
            return {
                applicants: [],
                data: [],
                period: '',
                search: '',
                total: '',
                enquiry_id: '',
                selectedApplicant: '',
                showEditApplicantModal: false,
                showRemoveApplicantModal: false,
                withdrawals: []
            }
        },

        mounted() {
            this.fetchApplicants()
            this.fetchSectors()
        },

        computed: {
            loading() {
                return !this.applicants.length > 0
            },

            filteredData() {
                return this.data.filter(item => {
                    return item.sector.toLowerCase().indexOf(this.search.toLowerCase()) !== -1
                        || item.name.toLowerCase().indexOf(this.search.toLowerCase()) !== -1
                        || item.adviser.toLowerCase().indexOf(this.search.toLowerCase()) !== -1
                        || item.submittedBy.toLowerCase().indexOf(this.search.toLowerCase()) !== -1
                        || item.type.toLowerCase().indexOf(this.search.toLowerCase()) !== -1
                })
            }
        },

        methods: {
            fetchApplicants() {
                this.$http
                    .get(route('api.apply.applicants.index'))
                    .then(res => {
                        this.applicants = res.data.data
                        this.total = this.applicants.length
                        this.period = moment(res.data.data.date, 'X').format('DD/MM')
                        this.applicants.forEach(app => {
                            this.data.push(this.setApplicant(app))
                        })
                    })
                    .catch(err => console.log(err))
            },

            setApplicant(app) {
                return {
                    data: app,
                    id: app.id,
                    ident: app.episode_ident,
                    enquiry_id: app.enquiry_id,
                    firstName: app.first_name,
                    surname: app.surname,
                    name: app.first_name + ' ' + app.surname,
                    email: app.email,
                    dob: app.dob ? moment(app.dob).format('DD/MM/YYYY') : '',
                    age: app.dob ? moment().diff(moment(app.dob), 'years') : '',
                    type: app.programme_type,
                    qualPlan: app.qualification_plan ? app.qualification_plan.description : null,
                    sector: app.sector.title,
                    sectorId: app.sector_id,
                    organisation: app.organisation_name,
                    startingOn: moment(app.starting_on).format('DD/MM/YYYY'),
                    adviser: app.adviser ? app.adviser.first_name + ' ' + app.adviser.surname : '',
                    submittedBy: app.submitted_by.first_name + ' ' + app.submitted_by.surname,
                    matchingString: app.surname && app.first_name ? app.surname.trim().toLowerCase() + app.first_name.trim().substr(0, 3).toLowerCase() : ''
                }
            },

            enquiryUrl(id) {
                return route('blink.enquiries.edit', id)
            },

            editApplicant(app) {
                this.showEditApplicantModal = true
                this.selectedApplicant = app.data
            },

            removeApplicant(app) {
                this.showRemoveApplicantModal = true
                this.selectedApplicant = app.data
            },

            hasMatch(app, index, filteredData, property) {
                try {
                    return app[property] == filteredData[index + 1][property]
                        || app[property] == filteredData[index - 1][property]
                } catch (err) {
                    //
                }
            },

            hasMatchingIdent(app, index, filteredData) {
                return app.ident && this.hasMatch(app, index, filteredData, 'ident')
            },

            hasMatchingName(app, index, filteredData) {
                return this.hasMatch(app, index, filteredData, 'matchingString')
            },

            hideApplicant(applicant) {
                const index = this.data.map(a => a.id).indexOf(applicant.id)
                this.data.splice(index, 1)
            },

            updateApplicant(applicant) {
                const index = this.data.map(a => a.id).indexOf(applicant.id)
                this.data.splice(index, 1, this.setApplicant(applicant))
            }
        }
    }
</script>