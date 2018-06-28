<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h4>Users On Probation</h4>
            </div>

            <div class="panel-body">
                <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
            </div>
        </div>
    </div>
</template>

<script>
    let moment = require('moment')

    export default {
        extends: require('../DataTable.vue'),

        data() {
            return {
                endpoint: '/api/v1/usermanager/users/probation/',
                columns: ['name', 'departments', 'probation_end_date'],
                options: {
                    templates: {actions: 'resource-actions'},
                    heading: {
                        name: 'Name',
                        manager: 'Departments',
                        probation_end_date: 'Probation EndDate',
                        actions: 'Actions',
                    }
                }
            }
        },

        methods: {
            setItems(users) {
                users.forEach(user => {
                    this.tableData.push({
                        user: user,
                        name: user.first_name + ' ' + user.surname,
                        departments: this.getMemberships(user.departments, 'department'),
                        probation_end_date: moment(user.meta.probation_end_date),
                        editUri: '/usermanager/account/' + user.username + '/edit',
                        deleteUri: '/usermanager/users/delete/' + user.id,
                    })
                })
            }
        },
    };
</script>
