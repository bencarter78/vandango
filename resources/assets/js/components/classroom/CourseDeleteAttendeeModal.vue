<template>
    <div v-bind:id="'modal_' + user.uuid" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" role="dialog" ref="modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Delete User From Course?</h3>
                </div>

                <div class="modal-body">
                    <p>You are about to delete this from the database. Please confirm if you wish to proceed.</p>
                </div>

                <div class="modal-footer text-left">
                    <form>
                        <button type="submit" class="btn btn-lg btn-danger" v-on:click="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['hasAccess', 'timetable', 'user', 'currentUserId'],

        methods: {
            submit (e) {
                e.preventDefault()
                this.deleteAttendee()
                this.closeModal()
            },

            deleteAttendee () {
                var self = this

                axios.post('/api/v1/classroom/timetable/' + self.timetable.id + '/cohort/' + self.user.id + '/' + self.user.type, {
                    _method: 'delete',
                    auth_user_id: self.currentUserId
                })
                     .then(function () {
                         self.$emit('user-was-removed', self.user)
                     })
                     .catch(function (errors) {
                         sweetAlert(errors.body.errors.title, errors.body.errors.detail, "error")
                     })
            },

            closeModal () {
                $('#' + this.$refs.modal.id).modal('toggle');
            }
        }
    }
</script>
