<template>
    <div>
        <button class="btn btn-secondary btn-sm" v-on:click="submit" v-if="attended == true">
            <i class="fa fa-check"></i>
        </button>

        <button class="btn btn-danger btn-sm" v-on:click="submit" v-if="attended == false">
            <i class="fa fa-times"></i>
        </button>
    </div>
</template>

<script>
    export default {
        props: ['user', 'timetable', 'currentUserId', 'attended'],

        methods: {
            submit () {
                var self = this

                axios.post('/api/v1/classroom/attendance', {
                    timetableId: self.timetable.id,
                    userId: self.user.id,
                    type: self.user.type,
                    authUser: self.currentUserId,
                    attended: self.attended
                })
                     .then(function (response) {
                         if (!response.data.errors) {
                             self.$emit('user-attendance-updated', {attended: self.attended})
                         }
                     })
                     .catch(function (error) {
                         console.debug(error)
                     })
            }
        }
    }
</script>