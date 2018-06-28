<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="flex border-blue pb-1 mb-4 font-bold border-b-4 font-size-larger uppercase">
                        <div class="flex-1">Search</div>
                    </div>
                    <errors-default v-if="form.errors.any()" :errors="form.errors.all()"/>

                    <form-dropdown :errors="form.errors"
                                   v-model="form.campaign_id"
                                   label="Campaign"
                                   :options="campaigns.map(c => ({value: c.id, label: c.name}))"
                                   :null-default-value="false"/>

                    <form-datepicker :errors="form.errors" v-model="form.from" label="From" :min-date="null"/>

                    <form-datepicker :errors="form.errors" v-model="form.to" label="To" :min-date="null"/>

                    <buttons-default class="mt-2" :isLoading="isLoading" text="Search" @submit="search"/>
                </div>

                <div class="col-md-9">
                    <div v-if="enquiries.length > 0">
                        <div class="mb-8">
                            <div class="flex border-blue pb-1 mb-4 font-bold border-b-4 font-size-larger uppercase">
                                <div class="flex-1">Overview</div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                    <tr>
                                        <th class="text-right">Enquiries</th>
                                        <th class="text-right">Opportunities</th>
                                        <th class="text-right">Value</th>
                                        <th class="text-right">Vacancy Adverts</th>
                                        <th class="text-right">Total Required</th>
                                        <th class="text-right">Identified</th>
                                        <th class="text-right">Starts</th>
                                    <tr>
                                        <td class="text-right">{{ enquiries.length }}</td>
                                        <td class="text-right">{{ opportunities.length }}</td>
                                        <td class="text-right">£{{ opportunities.reduce((carry, o) => carry + parseInt(o.value),
                                            0).toLocaleString() }}
                                        <td class="text-right">{{ vacancies.length }}</td>
                                        <td class="text-right">
                                            {{ vacancies.reduce((carry, o) => carry + parseInt(o.positions_count), 0) }}
                                        </td>
                                        <td class="text-right">{{ applicants.length }}</td>
                                        <td class="text-right">{{ applicants.filter(a => a.episode_ident).length }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex border-blue pb-1 mb-4 font-bold border-b-4 font-size-larger uppercase">
                            <div class="flex-1">Enquiries</div>
                        </div>

                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Organisation</th>
                                        <th class="text-right">Opportunities</th>
                                        <th class="text-right">Value</th>
                                        <th class="text-right">Vacancy Adverts</th>
                                        <th class="text-right">Total Required</th>
                                        <th class="text-right">Applicants</th>
                                        <th class="text-right">Starts</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="e in enquiries">
                                        <td>
                                            {{ e.statuses[e.statuses.length - 1].name }}
                                        </td>
                                        <td>{{ e.contact.organisation.name }}</td>
                                        <td class="text-right">
                                            {{ e.opportunities.filter(o => o.deleted_at == null).reduce((carry, o) =>
                                            carry +
                                            parseInt(o.quantity), 0) }}
                                        </td>
                                        <td class="text-right">
                                            £{{ e.opportunities.filter(o => o.deleted_at == null).reduce((carry, o) =>
                                            carry +
                                            parseInt(o.value),
                                            0).toLocaleString() }}
                                        </td>
                                        <td class="text-right">{{ e.vacancies.length }}</td>
                                        <td class="text-right">
                                            {{ e.vacancies.reduce((carry, o) => carry + parseInt(o.positions_count), 0)
                                            }}
                                        </td>
                                        <td class="text-right">
                                            {{ e.applicants.filter(a => a.deleted_at == null).length }}
                                        </td>
                                        <td class="text-right">
                                            {{ e.applicants.filter(a => a.deleted_at == null).filter(a =>
                                            a.episode_ident).length }}
                                        </td>
                                        <td class="text-center">
                                            <a class="is-link text-uppercase font-size-small" :href="'/blink/enquiries/' + e.id + '/edit'">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    import Form from './../../forms/form'

    export default {
        props: {
            campaigns: Array
        },

        data() {
            return {
                isLoading: false,
                form: new Form({
                    campaign_id: this.campaigns[0].id,
                    from: moment().subtract(30, 'day').format('DD/MM/YYYY'),
                    to: moment().format('DD/MM/YYYY'),
                }, false),
                enquiries: []
            }
        },

        computed: {
            opportunities() {
                return _.flatMap(this.enquiries.map(e => e.opportunities)).filter(o => o.deleted_at == null)
            },

            vacancies() {
                return _.flatMap(this.enquiries.map(e => e.vacancies))
            },

            applicants() {
                return _.flatMap(this.enquiries.map(e => e.applicants)).filter(a => a.deleted_at == null)
            }
        },

        mounted() {
            this.search()
        },

        methods: {
            search() {
                this.isloading = true
                this.form
                    .get(route('api.ignite.enquiries.index'))
                    .then(res => {
                        this.enquiries = res.data
                    })
                    .catch(err => console.log(err))
                this.isloading = false
            }
        }
    }
</script>