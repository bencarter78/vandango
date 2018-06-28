<template>
    <transition name="modal" class="task-runner">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <div class="pull-right">
                            <button type="button" class="close" @click="closeModal()">×</button>
                        </div>
                        <slot name="header">
                            <h3 class="modal-title">{{ $parent.title }}</h3>
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            <div class="form" v-show="$parent.showForm">
                                <p>You are about to run the audit. Please confirm if you wish to proceed.</p>
                                <div class="spacer-top-3x">
                                    <input type="submit" class="btn btn-success btn-lg" value="Run" @click="runAudit($event)">
                                </div>
                            </div>

                            <div v-show="! $parent.showForm" class="stages">
                                <ul class="list-group">
                                    <li class="list-group-item" v-for="msg in $parent.log" v-bind:key="msg.index">
                                        {{ msg }}
                                    </li>
                                </ul>
                            </div>

                            <div class="alert alert-success" v-if="$parent.completed">
                                Task successfully completed.
                            </div>

                            <div class="spacer-bottom-3x">
                                <spinner :loading="$parent.loading"></spinner>
                            </div>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import Spinner from '../loaders/Spinner.vue'

    export default {
        components: {Spinner},

        props: ['route'],

        mounted () {
            this.listen()
        },

        methods: {
            runAudit (event) {
                event.preventDefault()
                this.$emit('task-started', 'Your task has been added to the queue.')
                this.sendRequest()
            },

            sendRequest () {
                axios.get(this.route).then().catch((error) => {
                    console.error('We found an error'.error)
                })
            },

            listen () {
                Echo.private('auditor.task.runner')
                    .listen('Auditor.AuditWasRequested', (event) => {
                        this.$emit('message-received', event.data.msg)
                    })
                    .listen('Auditor.TaskRunnerStageWasReached', (event) => {
                        this.$emit('message-received', event.data.msg)
                    })
                    .listen('Auditor.TaskRunnerHasFinished', () => {
                        this.$emit('task-completed')
                    })
            },

            closeModal () {
                this.$emit('close-modal', false)
            }
        }
    }
</script>
