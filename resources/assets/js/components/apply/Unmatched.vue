<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                {{ total }}
                Unmatched Named Starts
            </h4>
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
                    <th>DOB</th>
                    <th>Type</th>
                    <th>Sector</th>
                    <th>Start Due</th>
                    <th>Adviser</th>
                    <th>Submitted By</th>
                    <th>Paperwork Received</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="app in filteredData">
                    <td>{{ app.firstName }} {{ app.surname }}</td>
                    <td>{{ app.dob }}</td>
                    <td>{{ app.type }}</td>
                    <td>{{ app.sector }}</td>
                    <td>{{ app.startingOn }}</td>
                    <td>{{ app.adviser }}</td>
                    <td>{{ app.submittedBy }}</td>
                    <td>
                        <span v-if="app.receivedOn">{{ app.receivedOn }}</span>

                        <small v-if="hasAccess && !app.receivedOn" class="is-link text-upper" @click="hasBeenReceived(app)">Mark Received</small>
                    </td>
                    <td class="text-center">
                        <ul v-if="canUpdate(app.data)" class="list-inline actions">
                            <li v-if="hasAccess">
                                <small class="is-link" @click="flagApplicant(app)">REPORT</small>
                            </li>
                            <li v-if="hasAccess">
                                <small class="text-gray-lighter">|</small>
                            </li>
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
                <apply-applicant-form :canPicsMatch="true" :applicant="selectedApplicant" request-method="update"></apply-applicant-form>
            </div>
        </modals-base>

        <apply-applicant-flag v-if="showFlagApplicantModal" :applicant="selectedApplicant" :user-id="userId" @modal-close="showFlagApplicantModal = false"></apply-applicant-flag>
        <apply-applicant-remove v-if="showRemoveApplicantModal" :applicant="selectedApplicant" @modal-close="showRemoveApplicantModal = false"></apply-applicant-remove>
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
                selectedApplicant: '',
                showEditApplicantModal: false,
                showFlagApplicantModal: false,
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
                    .get(route('api.apply.applicants.unmatched'))
                    .then(res => {
                        this.applicants = res.data.data.applicants
                        this.total = this.applicants.length
                        this.period = moment(res.data.data.date, 'X').format('DD/MM')
                        this.applicants.forEach((app, idx) => {
                            this.data.push({
                                data: app,
                                id: app.id,
                                firstName: app.first_name,
                                surname: app.surname,
                                name: app.first_name + ' ' + app.surname,
                                email: app.email,
                                dob: app.dob ? moment(app.dob).format('DD/MM/YYYY') : '',
                                age: app.dob ? moment().diff(moment(app.dob), 'years') : '',
                                type: app.programme_type,
                                sector: app.sector.name + ' ' + app.sector.code,
                                sectorId: app.sector_id,
                                organisation: app.organisation_name,
                                startingOn: moment(app.starting_on).format('DD/MM/YYYY'),
                                adviser: app.adviser ? app.adviser.first_name + ' ' + app.adviser.surname : '',
                                submittedBy: app.submitted_by.first_name + ' ' + app.submitted_by.surname,
                                receivedOn: app.received_at ? moment(app.received_at).format('DD/MM/YYYY') : ''
                            })
                        })
                    })
                    .catch(err => console.log(err))
            },

            editApplicant(app) {
                this.showEditApplicantModal = true
                this.selectedApplicant = app.data
            },

            flagApplicant(app) {
                this.showFlagApplicantModal = true
                this.selectedApplicant = app.data
            },

            removeApplicant(app) {
                this.showRemoveApplicantModal = true
                this.selectedApplicant = app.data
            },

            canUpdate(app) {
                return app.adviser_id == this.userId
                    || this.hasAccess
                    || this.userInSectorHierarchy(app.sector_id, this.userId)
            },

            hasBeenReceived(app) {
                this.$http
                    .patch(route('api.apply.applicants.paperwork-received', app.id))
                    .then(() => {
                        app.receivedOn = moment(app.received_at).format('DD/MM/YYYY')
                    })
                    .catch(err => console.log(err))
            }
        }
    }
</script>