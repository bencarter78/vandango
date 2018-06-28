<template>
    <div class="table-responsive">
        <v-client-table :data="tableData" :columns="columns" :options="options">
            <template slot="recipients" slot-scope="props">
                <span v-if="props.row.recipients.length > 100">
                    {{ props.row.recipients.substr(0, 100) }}...
                </span>
                <span v-else>{{ props.row.recipients }}</span>
            </template>

            <template v-if="hasAccess" slot="run" slot-scope="props">
                <task-modal :route="props.row.runTaskUri"></task-modal>
            </template>

            <template v-if="hasAccess" slot="actions" slot-scope="props">
                <actions-link text="Edit" :url="props.row.editUri"></actions-link>
                |
                <span class="font-size-small text-upper is-link" @click="clone(props.row.id)">Clone</span>
                |
                <actions-delete :uri="props.row.deleteUri" :user-id="userId"></actions-delete>
            </template>
        </v-client-table>
    </div>
</template>

<script>
    var DataTable = require('./../DataTable')

    export default {
        extends: DataTable,
        props: ['hasAccess', 'tasks', 'userId'],

        data() {
            return {
                columns: [
                    'category',
                    'task',
                    'recipients',
                    'frequency',
                    'run',
                    'actions'
                ],
                options: {
                    orderBy: {ascending: true, column: 'category'},
                    perPage: 250
                }
            }
        },

        mounted() {
            this.setItems()
        },

        methods: {
            setItems() {
                this.tasks.forEach(task => {
                    this.tableData.push({
                        id: task.id,
                        category: task.category.name,
                        task: task.title,
                        recipients: task.recipients,
                        frequency: _.capitalize(task.run_frequency),
                        runTaskUri: route('auditor.audit', task.id),
                        editUri: route('auditor.tasks.edit', task.id),
                        cloneUri: route('auditor.tasks.clone.store', task.id),
                        deleteUri: route('api.auditor.tasks.destroy', task.id)
                    })
                })
            },

            clone(id) {
                this.$http
                    .post(route('auditor.tasks.clone.store'), {task_id: id})
                    .then(() => {
                        flash('You have successfully cloned the task')
                        setTimeout(() => location.reload(), 1000)
                    })
                    .catch(err => console.log(err))
            }
        }
    }
</script>
