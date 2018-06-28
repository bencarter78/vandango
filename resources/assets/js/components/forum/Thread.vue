<template>
    <div>
        <div class="spacer-bottom-2x" v-html="thread.body"></div>

        <a :href="linkToChannel" class="label label-default font-size-small" :style="'background-color:' + thread.channel.color + ';'">
            <i class="fa fa-tag"></i>
            {{ thread.channel.name }}
        </a>

        <hr class="spacer-top-3x spacer-bottom-3x">

        <forum-replies :user-id="userId" :thread-slug="thread.slug"/>
    </div>
</template>

<script>
    export default {
        props: {
            threadData: String,
            userId: Number
        },

        data() {
            return {
                thread: ''
            }
        },

        computed: {
            linkToChannel() {
                return route('forum.threads.index', this.thread.channel.slug)
            }
        },

        created() {
            this.thread = JSON.parse(this.threadData)
        }
    }
</script>