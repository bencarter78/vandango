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
                columns: ['organisation', 'actions'],
                options: {
                    heading: {
                        organisation: 'Organisation',
                        actions: 'View'
                    },
                    orderBy: {ascending: true, column: 'organisation'}
                }
            }
        },

        methods: {
            setItems (items) {
                items.results.forEach(item => {
                    if (item.name != '') {
                        this.tableData.push({
                            id: item.id,
                            organisation: item.name,
                            showUri: '/blink/organisations/' + item.id
                        })
                    }
                })
            },
        }
    };
</script>
