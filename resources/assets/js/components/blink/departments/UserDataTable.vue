<template>
    <div class="table-responsive">
        <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
    </div>
</template>

<script>
    var DataTable = require('../../DataTable.vue')
    let moment = require('moment')

    export default {
        extends: DataTable,
        mixins: [require('../../../mixins/Apply.vue')],
        props: ['departmentId'],

        data() {
            return {
                columns: ['name', 'enquiries', 'opportunities', 'vacancies', 'identified', 'starts', 'projected'],
                options: {
                    perPage: 250,
                    perPageValues: [250],
                    orderBy: {ascending: true, column: 'name'}
                }
            }
        },

        created() {
            this.$http
                .get(route('api.blink.departments.show', {id: this.departmentId}))
                .then(res => this.setItems(res.data.data))
                .catch(err => console.log(err))
        },

        methods: {
            setItems(items) {
                items.forEach(item => {
                    this.tableData.push({
                        id: item.model.id,
                        name: item.model.first_name + ' ' + item.model.surname,
                        enquiries: item.enquiries.length ? item.enquiries.length : '',
                        opportunities: item.opportunities == 0 ? '' : item.opportunities,
                        projected: item.projectedIncome == 0 ? '' : '£' + item.projectedIncome,
                        vacancies: item.vacancies.length ? item.vacancies.length : '',
                        identified: item.applicants.length ? item.applicants.length : '',
                        starts: this.getStartsCount(item.applicants)
                    })
                })
            }
        }
    }
</script>
