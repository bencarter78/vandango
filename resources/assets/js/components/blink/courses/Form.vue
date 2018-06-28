<template>
    <form class="form">
        <errors-default v-if="form.errors.any()" :errors="form.errors.all()"></errors-default>

        <legend>Qualification</legend>
        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.title" field-name="title" label="Title"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-dropdown :errors="form.errors" v-model="form.sector_id" field-name="sector_id" label="Sector" :options="sectors"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-dropdown :errors="form.errors" v-model="form.type" field-name="type" label="Type" :options="type"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-datepicker v-if="form.type == 'Framework'" :errors="form.errors" v-model="form.framework_expires_on" field-name="framework_expires_on" label="Framework Expiry Date"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.code" field-name="code" label="Framework/Standard Code"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-area :errors="form.errors" v-model="form.description" field-name="description" label="Description"></form-text-area>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-dropdown :errors="form.errors" v-model="form.level" field-name="level" label="Level" :options="levels"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-dropdown :errors="form.errors" v-model="form.capability" field-name="capability" label="Capability" :options="capability"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-dropdown :errors="form.errors" v-model="form.awarding_body_id" field-name="awarding_body_id" label="Awarding Organisation" :options="awardingBodies"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.epa_provider" field-name="epa_provider" label="End Point Assessment Provider"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.aim_ref_standard" field-name="aim_ref_standard" label="Aim Reference (Standard)"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.aim_ref_mandatory" field-name="aim_ref_mandatory" label="Aim Reference (Mandatory)"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.aim_ref_optional" field-name="aim_ref_optional" label="Aim Reference (Optional)"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.programme_length" field-name="programme_length" label="Programme Length (16-18)"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.programme_length_adult" field-name="programme_length_adult" label="Programme Length (19+ Adult)"/>
        </div>

        <legend class="spacer-top-5x">Financial</legend>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.total_training" field-name="total_training" label="Total Cost of Training"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.total_epa" field-name="total_epa" label="Total Cost of EPA"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.total_negotiated" field-name="total_negotiated" label="Total Negotiated Price"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-dropdown :errors="form.errors" v-model="form.funding_band" field-name="funding_band" label="Funding Band" :options="bands"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.funding_cap" field-name="funding_cap" label="ESFA Funding Cap (Band Max)"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.co_investment" field-name="co_investment" label="Employer Co-Investment 10%"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.employer_contribution" field-name="employer_contribution" label="Employer contribution for charges above"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.additional_delivery" field-name="additional_delivery" label="Employer Additional Delivery"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.total_contribution" field-name="total_contribution" label="Total Employer Contribution"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.provider_incentive" field-name="provider_incentive" label="Provider Incentive £1,000"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-field :errors="form.errors" v-model="form.provider_uplift" field-name="provider_uplift" label="Provider Uplift"/>
        </div>

        <div class="form-group spacer-bottom-3x">
            <form-text-area :errors="form.errors" v-model="form.notes" field-name="notes" label="Notes"/>
        </div>

        <buttons-default :is-loading="isLoading" text="Save" @submit="submit"/>
    </form>
</template>

<script>
    import moment from 'moment'
    import Form from '../../../forms/form'
    import ErrorField from '../../errors/Field'

    export default {
        components: {ErrorField},
        props: ['course', 'url', 'method'],

        data() {
            return {
                awardingBodyData: [],
                form: new Form({
                    sector_id: '',
                    type: '',
                    framework_expires_on: '',
                    title: '',
                    code: '',
                    description: '',
                    level: '',
                    capability: '',
                    awarding_body_id: '',
                    epa_provider: '',
                    aim_ref_standard: '',
                    aim_ref_mandatory: '',
                    aim_ref_optional: '',
                    programme_length: '',
                    programme_length_adult: '',
                    total_training: '',
                    total_epa: '',
                    total_negotiated: '',
                    funding_band: '',
                    funding_cap: '',
                    co_investment: '',
                    employer_contribution: '',
                    additional_delivery: '',
                    total_contribution: '',
                    provider_incentive: '',
                    provider_uplift: '',
                    notes: ''
                }),
                isLoading: false,
                sectorData: []
            }
        },

        computed: {
            awardingBodies() {
                return this.awardingBodyData.map(item => ({value: item.id, label: item.name}))
            },

            capability() {
                return ['Accredited', 'Accredited but contact Sector', 'Contact Partnership Team'].map(item => ({
                    value: item,
                    label: item
                }))
            },

            type() {
                return ['Standard', 'Framework', 'Commercial'].map(t => ({value: t, label: t}))
            },

            levels() {
                return _.range(1, 8).map(l => ({value: l, label: l}))
            },

            bands() {
                return _.range(1, 31).map(l => ({value: l, label: l}))
            },

            sectors() {
                return this.sectorData.map(s => ({value: s.id, label: s.title}))
            }
        },

        mounted() {
            this.fetchSectors()
            this.fetchAwardingBody()
            this.setCourse()
        },

        methods: {
            fetchSectors() {
                this.fetch(route('api.usermanager.sectors.index'))
                    .then(res => {
                        this.sectorData = res.data
                    })
                    .catch(err => console.log(err))
            },

            fetchAwardingBody() {
                this.fetch(route('api.blink.awarding-bodies.index'))
                    .then(res => {
                        if (res.data.data.length) {
                            this.awardingBodyData = res.data.data
                        }
                    })
                    .catch(err => console.log(err))
            },

            fetch(url) {
                return new Promise((resolve, reject) => this.$http.get(url).then(res => resolve(res)).catch(err => reject(err)))
            },

            setCourse() {
                if (this.course) {
                    for (let prop in this.course) {
                        if (this.form[prop] == '') {
                            this.form[prop] = this.course[prop]
                        }
                    }
                    this.form.framework_expires_on = this.moment(this.form.framework_expires_on)
                }
            },

            submit() {
                this.isLoading = true
                this.form[this.method](this.url)
                    .then(() => {
                        this.isLoading = false
                        flash('You have successfully saved the course')
                        setTimeout(() => window.location.href = route('blink.courses.index'), 2000)
                    })
                    .catch(err => {
                        this.isLoading = false
                        window.scrollTo(0, 0)
                        console.log(err)
                    })
            },

            moment(date) {
                if (date) {
                    return moment(date).format('DD/MM/YYYY')
                }
            }
        }
    }
</script>