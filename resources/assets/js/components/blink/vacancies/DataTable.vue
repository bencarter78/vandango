<template>
    <v-client-table :data="tableData" :columns="columns" :options="options">
        <template slot="location" slot-scope="props">
            {{ props.row.town }}
            <small v-if="props.row.postcode">({{ props.row.postcode }})</small>
        </template>

        <template slot="closes" slot-scope="props">
            {{ props.row.closes_on }}
        </template>

        <template slot="created" slot-scope="props">
            {{ props.row.age }}
        </template>

        <template slot="actions" slot-scope="props">
            <small>
                <ul class="list-inline text-upper actions">
                    <li v-if="canEdit(props.row)">
                        <a class="is-link" :href="props.row.editUri">Edit</a> |
                    </li>
                    <li>
                        <a class="is-link" :href="props.row.showUri">View</a>
                    </li>
                </ul>
            </small>
        </template>
    </v-client-table>
</template>

<script>
    const moment = require('moment')
    var DataTable = require('../../DataTable.vue')

    export default {
        extends: DataTable,
        mixins: [require('../../../mixins/Blink.vue')],
        props: ['endpoint', 'draftStatus', 'hasAccess'],

        data() {
            return {
                columns: ['status', 'ref', 'sector', 'type', 'level', 'volume', 'hired', 'title', 'organisation', 'location', 'closes', 'applicationManager', 'submittedBy', 'created', 'actions'],
                options: {
                    headings: {
                        applicationManager: 'Application Manager',
                        closes: 'Closing Date',
                        ref: 'NAS Ref',
                        submittedBy: 'Submitted By'
                    },
                    orderBy: {ascending: true, column: 'organisation'},
                    columnsClasses: {
                        ref: 'text-center',
                        level: 'text-center',
                        volume: 'text-center',
                        hired: 'text-center',
                        closesOn: 'text-center',
                    }
                }
            }
        },

        methods: {
            setItems(items) {
                items.data.forEach(item => {
                    let data = {
                        id: item.id,
                        status: this.currentStatus(item.statuses).name,
                        ref: item.ref || '',
                        sector: item.sector ? item.sector.title : '',
                        type: item.qual_type == 0 ? 'Apprenticeship' : 'Traineeship',
                        level: item.level ? item.level.code : '',
                        volume: item.positions_count,
                        hired: item.hires.length,
                        title: item.title,
                        organisation: item.contact ? item.contact.organisation.name : '',
                        location: item.location ? `${item.location.town} ${item.location.postcode}` : '',
                        town: item.location ? item.location.town : '',
                        postcode: item.location ? item.location.postcode : '',
                        applicationManager: item.application_manager ? item.application_manager.first_name + ' ' + item.application_manager.surname : '',
                        submittedBy: item.submitted_by ? item.submitted_by.first_name + ' ' + item.submitted_by.surname : '',
                        closes: item.closes_on,
                        closes_on: item.closes_on ? moment(item.closes_on).format('DD/MM/YYYY') : '',
                        created: item.created_at,
                        age: moment(item.created_at).fromNow(),
                        showUri: '/blink/vacancies/' + item.id
                    }

                    if (this.hasAccess == true || data.status == this.draftStatus) {
                        data.editUri = '/blink/vacancies/' + item.id + '/edit'
                    }

                    this.tableData.push(data)
                })
            },

            canEdit(item) {
                return item.editUri && !item.ref
            }
        }
    }
</script>
