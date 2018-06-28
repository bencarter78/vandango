<template>
    <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
</template>

<script>
    var DataTable = require('../DataTable.vue')

    export default {
        extends: DataTable,

        data() {
            return {
                endpoint: '/api/v1/usermanager/departments/',
                modalAction: '/usermanager/departments/',
                columns: ['name', 'manager', 'director', 'sectors'],
                options: {
                    templates: {
                        actions: 'resource-actions'
                    }
                }
            }
        },

        mounted() {
            if (this.hasAccess) {
                this.columns.push('actions')
            }
        },

        methods: {
            setItems(items) {
                items.forEach(item => {
                    this.tableData.push({
                        department: item,
                        name: item.department,
                        manager: (item.manager) ? item.manager.first_name + ' ' + item.manager.surname : '',
                        director: (item.ad) ? item.ad.first_name + ' ' + item.ad.surname : '',
                        sectors: this.getMemberships(item.sectors, 'name'),
                        editUri: '/usermanager/departments/' + item.id + '/edit',
                        showUri: '/usermanager/departments/' + item.id,
                        deleteUri: '/usermanager/departments/' + item.id
                    })
                })
            }
        }
    }
</script>