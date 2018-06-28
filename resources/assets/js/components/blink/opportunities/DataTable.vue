<template>
    <div class="table-responsive">
        <v-client-table :data="tableData" :columns="columns" :options="options">
            <template slot="value" slot-scope="props">
                £{{ props.row.value.toLocaleString() }}
            </template>

            <template slot="expected" slot-scope="props">
                {{ props.row.expected_on }}
            </template>

            <template slot="actions" slot-scope="props">
                <actions-link text="View" :url="props.row.editUri"></actions-link>
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

        props: ['endpoint'],

        data() {
            return {
                columns: ['status', 'sector', 'type', 'organisation', 'quantity', 'value', 'expected', 'owner', 'actions'],
                options: {
                    customSorting: {
                        quantity(ascending) {
                            return (a, b) => {
                                return ascending
                                    ? parseInt(a.quantity) >= parseInt(b.quantity) ? 1 : -1
                                    : parseInt(a.quantity) <= parseInt(b.quantity) ? 1 : -1
                            }
                        }
                    },
                    columnsClasses: {
                        quantity: 'text-right',
                        value: 'text-right',
                    }
                }
            }
        },

        methods: {
            setItems(items) {
                items.data.forEach(item => {
                    let owner = this.enquiryOwner(item.enquiry.owners)

                    this.tableData.push({
                        id: item.id,
                        status: this.currentStatus(item.enquiry.statuses).name,
                        sector: item.sector.title,
                        type: item.programme_type ? item.programme_type : '',
                        organisation: item.enquiry.contact.organisation.name ? item.enquiry.contact.organisation.name : 'Unknown',
                        quantity: item.quantity,
                        value: item.value,
                        expected: item.expected_on,
                        expected_on: moment(item.expected_on).format('DD/MM/YYYY'),
                        owner: owner ? owner.first_name + ' ' + owner.surname : '',
                        editUri: route('blink.enquiries.edit', item.enquiry_id)
                    })
                })
            }
        }
    }
</script>
