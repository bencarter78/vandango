<template>
    <div>
        <span class="pull-right">
            <forum-subscriber
                :has-subscribed="hasSubscribed"
                :url="subscriptionsUrl"
                :user-id="userId"/>
        </span>
        <h4>
            {{ thread.title }}
        </h4>
        <div class="font-size-small spacer-bottom-1x">
            <ul class="list-inline">
                <li>
                    <i class="fa fa-user"></i>
                    Posted by
                    <a :href="linkToCreatorThreads" class="is-link">
                        {{ thread.creator.first_name }} {{ thread.creator.surname }}
                    </a>
                </li>
                <li>
                    <i class="fa fa-calendar"></i>
                    {{ postedAt }}
                </li>
                <li>
                    <i class="fa fa-eye"></i>
                    {{ thread.views }} views
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    import Form from './../../forms/form'

    export default {
        props: {
            hasSubscribed: Boolean,
            threadData: String,
            userId: Number
        },

        data() {
            return {
                hasSubscription: this.hasSubscribed,
                thread: '',
                form: new Form({
                    user_id: this.userId
                }, false)
            }
        },

        computed: {
            postedAt() {
                return moment(this.thread.created_at).fromNow()
            },

            linkToCreatorThreads() {
                return route('forum.threads.index') + `?by=${this.thread.creator.username}`
            },

            subscriptionsUrl() {
                return `/api/v1/forum/threads/${this.thread.slug}/subscriptions`
            }
        },

        created() {
            this.thread = JSON.parse(this.threadData)
        }
    }
</script>