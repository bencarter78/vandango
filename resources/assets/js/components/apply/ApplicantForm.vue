<template>
    <div>
        <errors-default :errors="errors"></errors-default>

        <div v-if="hasUpdated" class="alert alert-success">You have successfully updated the applicant</div>

        <legend>Qualification</legend>

        <div class="form-group spacer-bottom-3x">
            <dropdown
                :value="item ? item.sector_id : ''"
                @has-updated="selectedSector = $event"
                field-name="sector_id"
                label="Sector"
                :options="sectors">
            </dropdown>
        </div>

        <div class="form-group spacer-bottom-3x">
            <dropdown
                :value="item ? item.qualification_plan_id : ''"
                field-name="qualification_plan_id"
                label="Qualification Plan"
                :options="filteredPlans">
            </dropdown>
        </div>

        <div class="form-group spacer-bottom-3x">
            <dropdown :value="item ? item.programme_type : ''" field-name="programme_type" label="Programme Type" :options="progTypes"></dropdown>
        </div>

        <div class="form-group spacer-bottom-3x">
            <datepicker
                :disabled="item && item.starting_on"
                :value="item && item.starting_on ? moment(item.starting_on).format('DD/MM/YYYY') : ''"
                field-name="starting_on"
                label="Start Date"
                min-date="null">
            </datepicker>
        </div>

        <div class="form-group spacer-bottom-3x">
            <label>OneFile Centre</label>
            <div v-if="! (applicant && applicant.eportfolio)">
                <p>
                    Please leave blank if you <strong>DO NOT</strong> want a OneFile account automatically created.
                </p>
                <form-dropdown field-name="centre_id" :options="filteredCentres"/>
            </div>
            <div v-else class="alert alert-warning">
                <i class="fa fa-warning text-warning"></i>
                This applicant has already been registered for a {{ applicant.eportfolio.centre.name }} OneFile account.
            </div>
        </div>

        <legend>Identified Learner</legend>

        <div class="form-group spacer-bottom-3x">
            <label>Training Adviser</label>
            <search-users
                :user="item && item.adviser ? item.adviser.first_name + ' ' + item.adviser.surname : ''"
                :user_id="item && item.adviser_id">
            </search-users>
        </div>

        <div class="form-group spacer-bottom-3x">
            <text-field :value="item ? item.first_name : ''" field-name="first_name" label="First Name"></text-field>
        </div>

        <div class="form-group spacer-bottom-3x">
            <text-field :value="item ? item.surname : ''" field-name="surname" label="Surname"></text-field>
        </div>

        <div class="form-group spacer-bottom-3x">
            <datepicker
                :value="item && item.dob  ? moment(item.dob).format('DD/MM/YYYY') : ''"
                field-name="dob"
                label="Date of Birth"
                :min-date="null">
            </datepicker>
        </div>

        <div class="form-group spacer-bottom-3x">
            <text-field :value="item ? item.email : ''" field-name="email" label="Email"></text-field>
        </div>

        <div class="form-group spacer-bottom-3x" v-if="canPicsMatch">
            <div class="checkbox">
                <label>
                    <input id="match" name="match" type="checkbox" checked>
                    Attempt PICS match on Save?
                </label>
            </div>
        </div>

        <div class="form-group">
            <buttons-submit :is-loading="isLoading" @submit="submit"></buttons-submit>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        props: {
            applicant: {
                type: Object
            },
            canPicsMatch: {
                type: Boolean,
                default: false
            },
            enquiryId: {
                type: Number
            },
            qualificationType: {
                type: String
            },
            redirectUrl: {
                type: String
            },
            requestMethod: {
                type: String
            },
            shouldReload: {
                type: Boolean,
                default: true
            },
            userId: {
                type: Number,
            }
        },

        data() {
            return {
                errors: null,
                hasUpdated: false,
                isLoading: false,
                moment: moment,
                progTypes: [],
                qualPlans: [],
                sectors: [],
                centres: [],
                selectedSector: ''
            }
        },

        created() {
            this.setSectors()
            this.setQualPlans()
            this.setProgTypes()
            this.setCentres()
            this.selectedSector = this.item ? this.item.sector_id : ''
        },

        computed: {
            item() {
                return this.applicant ? this.applicant : vandango.applicant
            },

            filteredPlans() {
                return this.qualPlans.filter(plan => plan.sector_id == this.selectedSector).map(plan => plan)
            },

            filteredCentres() {
                if (this.selectedSector) {
                    return this.centres.filter(c => {
                        return c.sectors.map(s => s.id).indexOf(parseInt(this.selectedSector)) != -1
                    }).map(c => {
                        return {
                            value: c.id,
                            label: c.name
                        }
                    })
                }

                return this.centres.map(c => {
                    return {
                        value: c.id,
                        label: c.name
                    }
                })
            },

            route() {
                return this.requestMethod == 'update'
                    ? {method: 'put', url: route('api.apply.applicants.update', this.item.id)}
                    : {method: 'post', url: route('api.apply.applicants.store')}
            }
        },

        methods: {
            setSectors() {
                this.$http
                    .get('/api/v1/usermanager/sectors')
                    .then(res => this.buildSectorOptions(res.data))
                    .catch(err => console.log(err))
            },

            setQualPlans() {
                this.$http
                    .get(route('api.datastore.qualification-plans.index'))
                    .then(res => {
                        res.data.data.forEach(plan => {
                            this.qualPlans.push({
                                sector_id: plan.sector_id,
                                value: plan.id,
                                label: plan.description + ' [' + plan.code + ']'
                            })
                        })
                    })
                    .catch(err => console.log(err))
            },

            setProgTypes() {
                this.$http
                    .get(route('api.apply.qualification-types.index'), {params: {type: this.qualificationType}})
                    .then(res => res.data.data.forEach(type => this.progTypes.push({
                        label: type.name,
                        value: type.name
                    })))
                    .catch(err => console.log(err))
            },

            setCentres() {
                this.$http
                    .get(route('api.eportfolios.centres.index'))
                    .then(res => {
                        this.centres = res.data.data
                    })
                    .catch(err => console.log(err))
            },

            buildSectorOptions(data) {
                data.sort((a, b) => a.title < b.title ? -1 : a.title > b.title ? 1 : 0)
                    .forEach(sector => this.sectors.push({label: sector.title, value: sector.id}))
            },

            submit() {
                this.errors = null
                this.isLoading = true

                this.$http({
                    method: this.route.method,
                    url: this.route.url,
                    data: this.formData()
                })
                    .then(res => {
                        if (this.shouldReload) {
                            return this.redirectUrl ? window.location.replace(this.redirectUrl) : window.location.reload()
                        }

                        this.isLoading = false
                        this.hasUpdated = true
                        this.scrollToTop()
                        this.$emit('applicant-updated', res.data.data.applicant)
                    })
                    .catch(err => {
                        console.log(err.response)
                        this.scrollToTop()

                        if (err.response.status == 500) {
                            this.errors = {first: ["Error 500: We're sorry, the server has encountered an error. Please try again later."]}
                        } else {
                            this.errors = err.response.data
                        }

                        this.isLoading = false
                    })
            },

            formData() {
                return {
                    enquiry_id: this.enquiryId,
                    first_name: document.getElementById('first_name').value,
                    surname: document.getElementById('surname').value,
                    email: document.getElementById('email').value,
                    dob: document.getElementById('dob').value,
                    sector_id: document.getElementById('sector_id').value,
                    centre_id: document.getElementById('centre_id')
                        ? document.getElementById('centre_id').value
                        : null,
                    qualification_plan_id: document.getElementById('qualification_plan_id').value,
                    programme_type: document.getElementById('programme_type').value,
                    adviser_id: document.getElementsByName('user_id')[0].value,
                    starting_on: document.getElementsByName('starting_on')[0].value,
                    match: this.canPicsMatch ? document.getElementById('match').checked : null,
                    user_id: this.userId ? this.userId : vandango.authUser.id
                }
            },

            scrollToTop() {
                try {
                    document.getElementsByClassName('modal-container')[0].scrollTop = 0
                } catch (e) {
                    window.scrollTo(0, 0)
                }
            }
        }
    }
</script>
