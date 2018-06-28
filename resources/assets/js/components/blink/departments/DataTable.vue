<template>
    <div class="table-responsive">
        <v-client-table :data="tableData" :columns="columns" :options="options">
            <template slot="department" slot-scope="props">
                <a class="is-link" :href="props.row.showUri">
                    {{ props.row.department }}
                </a>
            </template>

            <template slot="opportunities" slot-scope="props">
                <span v-if="props.row.opportunities > 0">
                    {{ props.row.opportunities.toLocaleString() }}
                </span>
            </template>

            <template slot="projected" slot-scope="props">
                <span v-if="props.row.projected > 0">
                    £{{ props.row.projected.toLocaleString() }}
                </span>
            </template>
        </v-client-table>
    </div>
</template>

<script>
    var DataTable = require('../../DataTable.vue')

    export default {
        extends: DataTable,
        mixins: [require('../../../mixins/Apply.vue')],

        data() {
            return {
                columns: ['department', 'enquiries', 'opportunities', 'vacancies', 'identified', 'starts', 'projected'],
                options: {
                    perPage: 250,
                    perPageValues: [250],
                    orderBy: {ascending: true, column: 'department'},
                    columnsClasses: {
                        enquiries: 'text-right',
                        opportunities: 'text-right',
                        vacancies: 'text-right',
                        identified: 'text-right',
                        starts: 'text-right',
                        projected: 'text-right',
                    }
                }
            }
        },

        created() {
            this.$http
                .get(route('api.blink.departments.index'))
                .then(res => this.setItems(res.data.data))
                .catch(err => console.log(err))
        },

        methods: {
            setItems(items) {
                items.forEach(item => {
                    this.tableData.push({
                        id: item.model.id,
                        department: item.model.department,
                        enquiries: item.enquiries.length ? item.enquiries.length : '',
                        opportunities: item.opportunities,
                        projected: item.projectedIncome,
                        vacancies: item.vacancies.length ? item.vacancies.length : '',
                        identified: item.applicants.length ? item.applicants.length : '',
                        starts: this.getStartsCount(item.applicants),
                        showUri: route('blink.departments.show', {id: item.model.id})
                    })
                })
            }
        }
    }
</script>
