<template>
    <div class="table-responsive">
        <v-client-table :data="tableData" :columns="columns" :options="options">
            <template slot="completed" slot-scope="props">
                <span v-if="props.row.completed">
                    <i class="fa fa-check-square-o text-success"></i>
                    {{ props.row.completed }}
                </span>
                <span v-else>
                    <i class="fa fa-calendar text-warning"></i>
                    {{ props.row.due }}
                </span>
            </template>

            <template slot="document" slot-scope="props">
                <a v-if="props.row.document" :href="downloadPath(props.row.document)">
                    <i class="fa fa-download"></i>
                </a>
            </template>

            <template slot="actions" slot-scope="props">
                <actions-link text="Edit" :url="props.row.editUri"></actions-link>
                |
                <actions-delete text="Delete" :uri="props.row.deleteUri" :user-id="userId"></actions-delete>
            </template>
        </v-client-table>
    </div>
</template>

<script>
    var DataTable = require('./../DataTable.vue')
    let moment = require('moment')

    export default {
        extends: DataTable,
        props: ['userId'],

        data() {
            return {
                endpoint: route('api.cpd.activities.index', {user_id: this.userId}),
                columns: [
                    'title',
                    'completed',
                    'organisation',
                    'hours',
                    'grade',
                    'document',
                    'actions'
                ],
                options: {
                    columnsClasses: {
                        hours: 'text-center',
                        grade: 'text-center',
                        document: 'text-center',
                    },
                    orderBy: {ascending: false, column: 'displayDate'},
                    customSorting: {
                        completed(ascending) {
                            return (a, b) => {
                                return ascending
                                    ? parseInt(a.displayDate) >= parseInt(b.displayDate) ? 1 : -1
                                    : parseInt(a.displayDate) <= parseInt(b.displayDate) ? 1 : -1
                            }
                        }
                    },
                },
                grades: [
                    {value: 1, label: 'Outstanding'},
                    {value: 2, label: 'Good'},
                    {value: 3, label: 'Requires Improvement'},
                    {value: 4, label: 'Unsatisfactory'},
                ]
            }
        },

        methods: {
            setItems(items) {
                this.$emit('loaded', items.data)

                items.data.forEach(item => {
                    this.tableData.push({
                        user_id: item.user_id,
                        title: item.title,
                        completed: item.completed_on ? moment(item.completed_on).format('DD/MM/YYYY') : '',
                        due: moment(item.ends_on).format('DD/MM/YYYY'),
                        displayDate: item.completed_on ? moment(item.completed_on).format('X') : moment(item.ends_on).format('X'),
                        organisation: item.deliverer.name,
                        hours: item.total_hours,
                        grade: item.grade_id ? this.grades[item.grade_id - 1].label : 'Pending',
                        document: item.path,
                        editUri: route('cpd.activities.edit', item.id),
                        deleteUri: route('api.cpd.activities.destroy', item.id)
                    })
                })
            },

            downloadPath(path) {
                return route('api.uploads.index') + '?path=' + path
            }
        }
    }
</script>
