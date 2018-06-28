<template>
    <div>
        <div v-if="notifications.length" class="row">
            <div class="col-md-3">
                <div class="border-t border-l border-r border-grey-lighter max-h-screen overflow-scroll">
                    <div class="bg-grey-darkest text-grey-lightest px-4 py-4 border-b border-grey-lighter">
                        <div class="flex">
                            <div class="flex-grow mr-2">
                                <div>
                                    <i class="fa fa-inbox"></i>
                                    <span class="text-grey-light font-light">
                                    {{ notifications.length }} Notifications
                                </span>
                                </div>
                            </div>
                            <div class="mr-4">
                                {{ notifications.filter(n => n.read_at !== null).length }}
                                <i class="ml-2 fa fa-envelope-open-o"></i>
                            </div>
                            <div class="">
                                {{ notifications.filter(n => n.read_at == null).length }}
                                <i class="ml-2 fa fa-envelope-o"></i>
                            </div>
                        </div>
                    </div>

                    <div v-for="(n, index) in notifications"
                         :key="n.id"
                         class="bg-grey-lightest px-4 border-b border-grey-lighter hover:bg-grey-light cursor-pointer"
                         @click="setNotification(n, index)">
                        <div class="flex pt-2 pb-2">
                            <div class="flex items-center mr-4 pr-4 border-r border-grey-lighter">
                                <i v-if="n.read_at" class="fa fa-envelope-open-o"></i>
                                <i v-else class="fa fa-envelope text-blue"></i>
                            </div>
                            <div class="flex-grow">
                                <div class="text-grey-darker">
                                    {{ n.data.title }}
                                </div>
                                <div class="mt-2 text-grey font-size-smallest">
                                    {{ createdAt(notification.created_at).format('DD MMM YY HH:MM') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div v-if="notification">
                    <h4>{{ notification.data.title }}</h4>
                    <div class="border-b mb-8 text-grey-dark pb-2">
                        <i class="fa fa-calendar"></i>
                        {{ createdAt(notification.created_at).format('DD/MM/YYYY HH:MM') }}
                    </div>

                    <div class="mb-8">
                        {{ notification.data.message }}
                    </div>
                </div>
            </div>
        </div>

        <div v-else>
            <div class="font-size-larger">You have no notifications.</div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        props: {
            userId: Number
        },

        data() {
            return {
                notifications: [],
                selected: 0
            }
        },

        computed: {
            notification() {
                if (this.notifications.length) {
                    return this.notifications[this.selected]
                }
            }
        },

        mounted() {
            this.$http
                .get(route('api.usermanager.users.notifications.index', this.userId))
                .then(res => this.setNotifications(res.data.data))
                .catch(err => console.log(err))
        },

        methods: {
            setNotifications(notifications) {
                if (notifications.length) {
                    this.notifications = notifications
                    this.setNotification(this.notifications[0], 0)
                }
            },

            setNotification(notification, index) {
                this.selected = index
                this.markAsRead(notification.id, index)
            },

            markAsRead(id, index) {
                this.$http
                    .patch(route('api.usermanager.notifications.update', id))
                    .then(res => {
                        this.notifications[index].read_at = res.data.data.read_at
                    })
                    .catch(err => console.log(err))
            },

            createdAt(date) {
                return moment(date)
            }
        }
    }
</script>