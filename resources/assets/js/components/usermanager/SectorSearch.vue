<template>
    <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
</template>

<script>
    export default {
        extends: require('../DataTable.vue'),

        data() {
            return {
                endpoint: '/api/v1/usermanager/sectors/',
                columns: ['code', 'name', 'manager', 'director', 'department'],
                options: {
                    templates: {actions: 'resource-actions'},
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
                        sector: item,
                        code: item.code,
                        name: item.name,
                        manager: this.manager(item),
                        director: this.director(item),
                        department: this.department(item),
                        editUri: '/usermanager/sectors/' + item.id + '/edit',
                        showUri: '/usermanager/sectors/' + item.id,
                        deleteUri: '/usermanager/sectors/' + item.id,
                    })
                })
            },

            manager(sector) {
                if (sector.department) {
                    return sector.department.manager
                        ? [sector.department.manager.first_name, sector.department.manager.surname].join(' ')
                        : ''
                }
            },

            director(sector) {
                if (sector.department) {
                    return sector.department.ad
                        ? [sector.department.ad.first_name, sector.department.ad.surname].join(' ')
                        : ''
                }
            },

            department(sector) {
                if (sector.department) {
                    return sector.department.department
                }
            }
        }
    }
</script>