<template>
    <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
</template>

<script>
    var DataTable = require('../DataTable.vue')

    export default {
        extends: DataTable,

        props: {
            hasAccess: {
                default: 0
            }
        },

        data() {
            return {
                endpoint: '/api/v1/roommate/rooms/',
                modalAction: '/roommate/rooms/delete/',
                columns: ['name', 'site', 'capacity'],
                options: {
                    heading: {
                        name: 'Name',
                        site: 'Site',
                        capacity: 'Capacity',
                        actions: 'Actions',
                    },
                    templates: {actions: 'resource-actions'}
                }
            }
        },

        methods: {
            setItems(rooms){
                rooms.forEach(room => {
                    this.tableData.push({
                        room: room,
                        name: room.name,
                        site: room.site.name + ' - ' + room.site.location.town,
                        capacity: room.capacity,
                        editUri: '/roommate/rooms/' + room.id + '/edit',
                        deleteUri: '/roommate/rooms/' + room.id,
                    })
                })
            }
        },
    };
</script>
