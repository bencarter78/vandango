<template>
    <div class="table-responsive">
        <v-client-table :data="tableData" :columns="columns" :options="options">
            <template slot="levy" slot-scope="props">
                <div class="text-center">
                    <span v-if="props.row.levy"><i class="fa fa-check-square-o"></i></span>
                </div>
            </template>

            <template slot="organisation" slot-scope="props">
                <a :href="props.row.showUri" class="is-link">{{ props.row.organisation }}</a>
            </template>

            <template slot="value" slot-scope="props">
                £{{ props.row.value.toLocaleString() }}
            </template>
        </v-client-table>
    </div>
</template>

<script>
    var DataTable = require('../../DataTable.vue')
    let moment = require('moment')

    export default {
        extends: DataTable,
        mixins: [require('../../../mixins/Blink.vue')],

        data() {
            return {
                endpoint: route('api.blink.organisations.enquiries.index'),
                columns: ['levy', 'organisation', 'enquiries', 'opportunities', 'vacancies', 'applicants', 'starts', 'value'],
                options: {
                    perPage: 100,
                    orderBy: {ascending: false, column: 'value'},
                    columnsClasses: {
                        levy: 'text-center',
                        enquiries: 'text-right',
                        opportunities: 'text-right',
                        vacancies: 'text-right',
                        applicants: 'text-right',
                        starts: 'text-right',
                        value: 'text-right',
                    }
                }
            }
        },

        methods: {
            setItems(items) {
                items.data.forEach(item => {
                    this.tableData.push({
                        id: item.id,
                        levy: item.levy_pot >= 3000000,
                        organisation: item.name ? item.name : 'Unknown',
                        enquiries: item.enquiries.length,
                        opportunities: this.getOpportunities(item.enquiries),
                        vacancies: this.getVacancies(item.enquiries),
                        applicants: this.getApplicants(item.enquiries),
                        starts: this.getStarts(item.enquiries),
                        value: this.getValue(item.enquiries),
                        showUri: route('blink.organisations.show', item.id)
                    })
                })
            },

            getOpportunities(enquiries) {
                return enquiries.reduce((carry, e) => {
                    return carry + e.opportunities
                                    .filter(opp => opp.deleted_at == null)
                                    .reduce((carry, opp) => carry + parseInt(opp.quantity), 0)
                }, 0)
            },

            getVacancies(enquiries) {
                return enquiries.reduce((carry, e) => {
                    return carry + e.vacancies.filter(v => v.deleted_at == null).length
                }, 0)
            },

            getApplicants(enquiries) {
                return enquiries.reduce((carry, e) => carry + e.applicants.length, 0)
            },

            getStarts(enquiries) {
                return enquiries.reduce((carry, e) => {
                    return carry + e.applicants.filter(a => a.episode_ident != null).length
                }, 0)
            },

            getValue(enquiries) {
                return enquiries.reduce((carry, e) => {
                    return carry + e.opportunities.reduce((carry, opp) => carry + parseInt(opp.value), 0)
                }, 0)
            }
        }
    }
</script>