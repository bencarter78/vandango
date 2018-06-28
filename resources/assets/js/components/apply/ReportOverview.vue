<template>
    <div>
        <div v-if="!hasLoaded" class="spacer-top-5x">
            <loaders-pulse :is-loading="true"></loaders-pulse>
        </div>
        <div v-else>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        <a :href="createUrl" class="btn btn-secondary">
                            <i class="fa fa-plus"></i> Add
                        </a>
                    </div>
                    <h4>
                        Starts Pipeline
                        <small>
                            {{ moment(data.contractYear[0].start.date).format('YY')
                            }}/{{ moment(data.contractYear[11].end.date).format('YY') }}
                        </small>
                    </h4>
                </div>

                <div class="panel-body">
                    <div class="well-gray-light text-center spacer-bottom-2x">
                        <ul class="list-inline">
                            <li v-for="type in progTypes">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" v-model="selectedProgTypes" :value="type.value">
                                        {{ type.label }}
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th></th>
                                <th v-for="month in data.contractYear" class="text-right">
                                    P{{ month.period }}<br/>
                                    {{ moment(month.start.date).format('MMM') }}
                                </th>
                                <th class="text-right">
                                    In Year <br/>
                                    {{ moment(data.contractYear[0].start.date).format('YY') }} /
                                    {{ moment(data.contractYear[11].end.date).format('YY') }}
                                </th>
                            </tr>
                            <tr>
                                <th class="text-right">Total</th>
                                <th v-for="month in data.contractYear" class="text-right">
                                    {{ applicantsInPeriod(applicants, month.period).length }} /
                                    {{ filterStarts(applicantsInPeriod(applicants, month.period)).length }}
                                </th>
                                <th class="text-right">
                                    {{ applicants.length }} /
                                    {{ filterStarts(applicants).length }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="sector in data.sectors">
                                <td>{{ sector.title }}</td>
                                <td v-for="month in data.contractYear" class="text-right">
                            <span class="is-link" @click="selectSectorPeriod(sectorApplicants(sector), month, sector)">
                                {{ applicantsInPeriod(sectorApplicants(sector), month.period).length }} /
                                {{ filterStarts(applicantsInPeriod(sectorApplicants(sector), month.period)).length }}
                            </span>
                                </td>
                                <td class="text-right">
                                    {{ sectorApplicants(sector).length }} /
                                    {{ filterStarts(sectorApplicants(sector)).length }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <apply-sector-period-applicants v-if="showModal" :data="selected" @modal-close="toggleModal"></apply-sector-period-applicants>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        mixins: [require('./../../mixins/Modal.vue')],

        data() {
            return {
                createUrl: route('apply.applicants.create'),
                data: {
                    sectors: [],
                    applicants: [],
                    contractYear: []
                },
                hasLoaded: false,
                moment: moment,
                periods: [],
                progTypes: [
                    {label: 'Study Programme', value: 'Study Programme'},
                    {label: 'Traineeship', value: 'Traineeship'},
                    {label: 'Standard', value: 'Standard'},
                    {label: 'Framework', value: 'Framework'},
                    {label: 'ESF', value: 'ESF'},
                    {label: 'Advanced Learner Loan', value: 'Advanced Learner Loan'},
                    {label: 'Adult Education Budget (Classroom/WBL)', value: 'Adult Education Budget (Classroom/WBL)'},
                    {label: 'Commercial', value: 'Commercial'}
                ],
                selectedProgTypes: [],
                selected: '',
                showFilter: false,
                showModal: false
            }
        },

        computed: {
            applicants() {
                return this.data.applicants.filter(app => this.selectedProgTypes.indexOf(app.programme_type) != -1)
            }
        },

        created() {
            this.fetchData()
        },

        methods: {
            fetchData() {
                this.$http
                    .get(route('api.apply.sectors.index'))
                    .then(res => this.onSuccess(res))
                    .catch(err => this.onFail(err))
            },

            onSuccess(res) {
                this.setData(res.data.data)
                this.toggleLoadedState()
            },

            onFail(err) {
                console.log(err)
            },

            setData(data) {
                this.data.sectors = data.sectors
                this.data.contractYear = data.contractYear
                this.data.applicants = this.extractApplicants(this.data.sectors)
            },

            extractApplicants(sectors) {
                return sectors.map(s => s.applicants).reduce((carry, item) => carry.concat(item))
            },

            applicantsInPeriod(applicants, period) {
                if (this.data.contractYear.length > 0) {
                    let currentPeriod = this.getPeriod(period)
                    let start = moment(currentPeriod.start.date)
                    let end = moment(currentPeriod.end.date)
                    return applicants.filter(app => moment(app.starting_on).isBetween(start, end, null, '[]'))
                }
            },

            getPeriod(period) {
                return this.data.contractYear.filter(year => year.period == period)[0]
            },

            sectorApplicants(sector) {
                return this.applicants.filter(app => app.sector_id == sector.id)
            },

            selectSectorPeriod(applicants, period, sector) {
                this.selected = {
                    applicants: this.applicantsInPeriod(applicants, period.period),
                    month: period,
                    progTypes: this.selectedProgTypes,
                    sector: sector
                }
                this.toggleModal()
            },

            filterStarts(applicants) {
                return applicants.filter(app => app.started_on != null)
            },

            toggleLoadedState() {
                this.hasLoaded = !this.hasLoaded
            }
        }
    }
</script>

<style scoped>
    .well-gray-light ul {
        margin: 0;
    }
</style>