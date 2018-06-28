<template>
    <div class="table-responsive">
        <v-client-table :data="tableData" :columns="columns" :options="options">
            <template slot="updated" slot-scope="props">
                {{ props.row.updated_at }}
            </template>

            <template slot="actions" slot-scope="props">
                <actions-link text="View" :url="props.row.showUri"></actions-link>
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
        props: ['hasAccess', 'endpoint'],

        data() {
            return {
                columns: [
                    'status',
                    'name',
                    'organisation',
                    'owner',
                    'updated',
                    'actions'
                ],
                options: {
                    orderBy: {ascending: true, column: 'status'},
                }
            }
        },

        methods: {
            setItems(items) {
                items.results.forEach(item => {
                    let owner = this.enquiryOwner(item.owners)

                    this.tableData.push({
                        enquiry: item,
                        id: item.id,
                        status: this.currentStatus(item.statuses).name,
                        name: this.getContactName(item.contact),
                        organisation: item.contact.organisation.name ? item.contact.organisation.name : 'Unknown',
                        owner: owner ? owner.first_name + ' ' + owner.surname : 'Marketing',
                        updated: item.updated_at,
                        updated_at: moment(item.updated_at).fromNow(),
                        showUri: '/blink/enquiries/' + item.id + '/edit'
                    })
                })
            },

            getContactName(contact) {
                let name = []
                if (contact.first_name) {
                    name.push(contact.first_name)
                }

                if (contact.surname) {
                    name.push(contact.surname)
                }

                return name.join(' ')
            }
        }
    }
</script>
