<template>
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <div class="pull-right" v-if="hasAccess == true">
                <a href="/usermanager/users/register" class="btn btn-secondary"><i class="fa fa-plus"></i> Register User</a>
            </div>
            <h4>All Users</h4>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
            </div>
        </div>
    </div>
</template>

<script>
    import DataTable from './../DataTable'

    export default {
        extends: DataTable,

        props: {
            hasAccess: {
                default: 0
            }
        },

        data() {
            return {
                endpoint: '/api/v1/usermanager/users',
                columns: ['name', 'departments', 'sectors', 'contact'],
                options: {
                    heading: {
                        name: 'Name',
                        manager: 'Departments',
                        sectors: 'Sectors',
                        contact: 'Contact',
                    },
                    templates: {
                        name: 'user-full-name',
                        contact: 'user-contact-details',
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
            setItems(users) {
                users.forEach(user => {
                    this.tableData.push({
                        user: user,
                        name: user.first_name + ' ' + user.surname,
                        departments: this.getMemberships(user.departments, 'department'),
                        sectors: this.getMemberships(user.sectors, 'name'),
                        editUri: '/usermanager/account/' + user.username + '/edit',
                        deleteUri: '/usermanager/users/delete/' + user.id,
                    })
                })
            }
        }
    }
</script>
