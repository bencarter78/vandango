<template>
    <v-client-table :data="tableData" :columns="columns" :options="options">
        <template slot="actions" slot-scope="props">
            <actions-link text="View" :url="props.row.showUri"></actions-link>
            <span v-if="hasAccess">|</span>
            <actions-link v-if="hasAccess" text="Edit" :url="props.row.editUri"></actions-link>
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
                columns: ['sector', 'title', 'description', 'type', 'actions']
            }
        },

        methods: {
            setItems(items) {
                items.data.forEach(item => {
                    this.tableData.push({
                        id: item.id,
                        sector: item.sector.title,
                        title: item.title,
                        description: item.description,
                        type: item.type,
                        editUri: '/blink/courses/' + item.id + '/edit',
                        showUri: '/blink/courses/' + item.id
                    })
                })
            }
        }
    }
</script>
