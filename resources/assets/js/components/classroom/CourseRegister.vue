<template>
    <div>
        <div class="panel-heading">
            <h4>
                {{ course.name }} Register
                <small>
                    <ul class="list-inline pull-right">
                        <li><i class="fa fa-calendar"></i> {{ date(timetable.starts_at).format('DD MMMM YYYY') }}</li>
                        <li>
                            <i class="fa fa-clock-o"></i>
                            {{ date(timetable.starts_at).format('H:mm') }} - {{ date(timetable.ends_at).format('H:mm')
                            }}
                        </li>
                        <li>
                            <i class="fa fa-map-marker"></i> {{ course.venue }},
                            {{ course.town }}
                        </li>
                    </ul>
                </small>
            </h4>
        </div>

        <div class="panel-body">

            <div class="spacer-bottom-3x" v-if="hasAccess && isBeforeStartTime">

                <ul class="nav nav-tabs spacer-bottom-2x" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#user" aria-controls="user" role="tab" data-toggle="tab">Add Staff Member</a>
                    </li>
                    <li role="presentation">
                        <a href="#guest" aria-controls="guest" role="tab" data-toggle="tab">Add Guest</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="user">
                        <course-add-user
                                :timetable="timetable"
                                :current-user-id="currentUserId"
                                v-on:user-was-added="addAttendee($event, 'users')">
                        </course-add-user>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="guest">
                        <course-add-guest
                                :timetable="timetable"
                                :current-user-id="currentUserId"
                                v-on:user-was-added="addAttendee($event, 'guests')">
                        </course-add-guest>
                    </div>
                </div>

            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="attendees">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th class="text-center" v-if="hasAccess">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="user in orderedItems" v-bind:id="'attendee_' + user.uuid">
                        <td>
                            <a v-bind:href="'/classroom/manager/staff/' + user.id">{{ user.name }}</a>
                            <span v-if="user.agreement == 0" class="badge badge-warning">Not Agreed</span>
                        </td>
                        <td>
                            <span v-html="user.departments"></span>
                            {{ user.company }}
                        </td>
                        <td class="text-center" v-if="hasAccess">
                            <course-delete-attendee-modal
                                    :timetable="timetable"
                                    :current-user-id="currentUserId"
                                    :user="user"
                                    v-on:user-was-removed="removeAttendee($event)">
                            </course-delete-attendee-modal>

                            <attendee-actions
                                    :user="user"
                                    :timetable="timetable"
                                    :current-user-id="currentUserId"
                                    :is-admin="isAdmin">
                            </attendee-actions>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import CourseAddUser from "./CourseAddUser.vue";
    import CourseAddGuest from "./CourseAddGuest.vue";
    import AttendeeActions from './AttendeeActions.vue'
    import CourseDeleteAttendeeModal from "./CourseDeleteAttendeeModal.vue";
    import Helpers from '../../libs/Helpers'

    let moment = require('moment')
    let uuidV4 = require('uuid/v4')

    export default {
        components: {CourseAddUser, CourseAddGuest, AttendeeActions, CourseDeleteAttendeeModal},

        props: ['courseId', 'hasAccess', 'currentUserId', 'isAdmin'],

        data () {
            return {
                timetable: '',
                course: {
                    name: '',
                    venue: '',
                    town: ''
                },
                attendees: [],
                isBeforeStartTime: false
            }
        },

        mounted () {
            this.getCourse(this.courseId)
        },

        computed: {
            orderedItems: function () {
                return Helpers.orderBy(this.attendees, 'name')
            }
        },

        methods: {
            getCourse(id) {
                var self = this
                axios.get('/api/v1/classroom/timetable/' + id)
                     .then(function (response) {
                         self.timetable = response.data
                         self.course.name = self.timetable.course.name
                         self.course.venue = self.timetable.venue.name
                         self.course.town = self.timetable.venue.site.location.town
                         self.setAttendees(self.timetable.users, 'users')
                         self.setAttendees(self.timetable.guests, 'guests')
                         self.isBeforeStartTime = moment() < moment(self.timetable.starts_at)
                     })
            },

            setAttendees (users, type) {
                users.forEach(user => {
                    this.addAttendee(user, type)
                })
            },

            addAttendee (user, type) {
                this.attendees.push({
                    uuid: uuidV4(),
                    id: user.id,
                    name: user.first_name + ' ' + user.surname,
                    departments: user.departments ? this.getMemberships(user.departments, 'department') : 'Guest',
                    company: user.company ? ' from ' + user.company : '',
                    type: type,
                    agreement: this.getAgreementStatus(user.agreements),
                    attended: user.pivot ? user.pivot.attended : 0,
                    attendanceMarkedAt: user.pivot ? user.pivot.deleted_at : null
                })
            },

            getMemberships (items, key) {
                let html = ['<ul class="list-unstyled">']
                this.sort(items, key).forEach(item => {
                    html.push('<li>' + item[key] + '</li>')
                })
                html.push('</ul>')

                return html.join("\n");
            },

            sort(items, key) {
                return items.sort(function (a, b) {
                    if (a[key] < b[key]) return -1
                    if (a[key] > b[key]) return 1
                    return 0
                })
            },

            getAgreementStatus (agreements) {
                if (this.timetable.course.is_agreement_required == 0) {
                    return 1;
                }

                if (agreements) {
                    agreements.forEach(a => {
                        if (a.timetable_id == this.timetable.id) {
                            return a.is_signed
                        }
                    })
                }

                return 0;
            },

            removeAttendee (user) {
                for (let i = 0; i < this.attendees.length; i++) {
                    if (this.attendees[i].uuid == user.uuid) {
                        this.attendees.splice(i, 1)
                    }
                }
            },

            date (date) {
                return moment(date)
            }
        }
    }
</script>
