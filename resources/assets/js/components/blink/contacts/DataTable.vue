<template>
    <v-client-table :data="tableData" :columns="columns" :options="options">
        <template slot="actions" slot-scope="props">
            <actions-link text="View" :url="props.row.showUri"></actions-link>
        </template>
    </v-client-table>
</template>

<script>
    var DataTable = require('../../DataTable.vue')

    export default {
        extends: DataTable,

        props: ['hasAccess', 'endpoint'],

        data() {
            return {
                columns: ['contact', 'organisation', 'actions'],
                options: {
                    heading: {
                        contacts: 'Contact',
                        organisation: 'Organisation',
                    },
                    orderBy: {ascending: true, column: 'contact'}
                }
            }
        },

        methods: {
            setItems(items) {
                items.results.forEach(item => {
                    if (item.first_name != '') {
                        this.tableData.push({
                            id: item.id,
                            contact: this.getName(item),
                            organisation: item.organisation.name,
                            showUri: '/blink/contacts/' + item.id
                        })
                    }
                })
            },

            getName(contact) {
                var firstName = contact.first_name ? contact.first_name + ' ' : ''
                var surname = contact.surname ? contact.surname : ''
                return firstName + surname
            }
        }
    }
</script>
