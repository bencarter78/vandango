<template>
    <article>
        <div class="heading">
            <ul class="list-inline">
                <li class="text-gray-dark font-size-larger">{{ reply.owner.first_name }} {{ reply.owner.surname }}</li>
                <li class="font-size-small text-gray-light">{{ createdAt(reply.created_at) }}</li>
            </ul>
        </div>

        <div v-html="reply.body"></div>
    </article>
</template>

<script>
    import moment from 'moment'

    export default {
        props: {
            reply: Object
        },

        methods: {
            createdAt(value) {
                return moment(value).fromNow()
            },
        }
    }
</script>