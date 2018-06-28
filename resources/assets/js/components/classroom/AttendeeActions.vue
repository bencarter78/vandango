<template>
    <div>
        <ul class="list-inline" v-if="! marked">
            <li v-if="user.attendanceMarkedAt">
                <span v-if="user.attended == 1">Attended</span>
                <span v-else>Absent</span>
            </li>

            <li v-if="! isBeforeStartTime && isAdmin && !user.attendanceMarkedAt">
                <user-attended :user="user" :timetable="timetable" :current-user-id="currentUserId" attended="1"></user-attended>
            </li>

            <li v-if="! isBeforeStartTime && isAdmin && !user.attendanceMarkedAt">
                <user-attended
                        :user="user"
                        :timetable="timetable"
                        :current-user-id="currentUserId"
                        attended="0"
                        v-on:user-attendance-updated="updateUserAttendance($event)">
                </user-attended>
            </li>

            <li v-if="isBeforeStartTime">
                <a class="btn btn-circle btn-danger btn-sm" role="button" v-bind:data-target="'#modal_' + user.uuid" data-toggle="modal">
                    <i class="fa fa-trash"></i>
                </a>
            </li>
        </ul>

        <div v-if="marked">
            <i>Marked as {{ attended }}</i>
            <a v-on:click="undo" style="cursor:pointer;">
                <small>[Undo]</small>
            </a>
        </div>
    </div>
</template>

<script>
    import UserAttended from './Button/UserAttended.vue'

    let moment = require('moment')

    export default {
        components: {UserAttended},

        props: ['user', 'timetable', 'currentUserId', 'isAdmin'],

        data () {
            return {
                marked: false,
                attended: '',
                isBeforeStartTime: moment() < moment(this.timetable.starts_at)
            }
        },

        methods: {
            undo () {
                this.marked = !this.marked
            },

            updateUserAttendance (data) {
                this.marked = true
                this.attended = data.attended == true ? 'attended' : 'absent'
            }
        }

    }
</script>
