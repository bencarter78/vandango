<template>
    <div class="spacer-left-5x">
        <a name="replies" ref="replies"></a>
        <forum-reply v-for="reply in replies.data" :key="reply.id" :reply="reply" class="spacer-bottom-5x"/>

        <vd-paginator :data-set="replies" @changed="fetch" class="text-center"></vd-paginator>

        <div class="spacer-top-5x">
            <forum-reply-add :user-id="userId" :thread-slug="threadSlug" @created="addReply"/>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            userId: Number,
            threadSlug: String
        },

        data() {
            return {
                replies: [],
            }
        },

        created() {
            this.fetch(1)
        },

        methods: {
            addReply(e) {
                this.replies.data.push(e)
                this.$emit('created', e)
            },

            fetch(pageIndex) {
                this.$http
                    .get(route('api.forum.threads.replies.index', this.threadSlug), {params: {page: pageIndex}})
                    .then(res => {
                        this.replies = res.data.data
                        window.scrollTo(0, 0)
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }
        }
    }
</script>