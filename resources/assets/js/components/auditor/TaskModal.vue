<template>
    <div>
        <a class="btn btn-success btn-circle" title="Send now" id="show-modal" @click="displayModal()">
            <i class="fa fa-paper-plane"></i>
        </a>

        <task-runner
                v-if="showModal"
                :route="route"
                @close-modal="closeModal()"
                @task-started="startTask($event)"
                @message-received="addToLog($event)"
                @task-completed="completeTask($event)"
        ></task-runner>
    </div>
</template>

<script>
    import TaskRunner from './TaskRunner.vue'

    export default {
        components: {TaskRunner},

        props: ['route'],

        data () {
            return {
                showModal: false,
                title: 'Run The Audit?',
                showForm: true,
                log: [],
                loading: false,
                completed: false
            }
        },

        methods: {
            displayModal () {
                this.reset()
                this.showModal = true
            },

            closeModal () {
                this.reset()
                this.showModal = false
            },

            reset () {
                this.title = 'Run The Audit?'
                this.showForm = true
                this.log = []
                this.loading = false
                this.completed = false
            },

            startTask (msg) {
                console.log(msg)
                this.title = 'Running Task'
                this.showForm = false
                this.loading = true
                this.addToLog(msg)
            },

            completeTask () {
                this.title = 'Task Finished'
                this.loading = false
                this.completed = true
            },

            addToLog (msg) {
                this.log.push(msg)
            }
        }
    }
</script>