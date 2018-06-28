<template>
    <div>
        <div class="spacer-bottom-3x">
            <form-dropdown label="Channel" field-name="channel_id" v-model="form.channel_id" :options="channelOptions"/>
        </div>

        <div class="spacer-bottom-3x">
            <form-text-field
                label="Title"
                field-name="title"
                v-model="form.title"
                placeholder="This is my interesting title!"/>
        </div>

        <div class="spacer-bottom-3x">
            <form-text-editor
                v-model="form.body"
                :errors="form.errors"
                :reset="resetEditor"
                field-name="body"
                label="Ask Away"
                placeholder="What's on your mind?"/>
        </div>

        <buttons-default :isLoading="isLoading" class="spacer-top-x" text="Save" @submit="submit"></buttons-default>
    </div>
</template>

<script>
    import Form from './../../forms/form'

    export default {
        props: {
            channelsData: String,
            userId: Number
        },

        data() {
            return {
                channels: [],
                form: new Form({
                    user_id: this.userId,
                    channel_id: '',
                    title: '',
                    body: ''
                }),
                resetEditor: false,
                isLoading: false
            }
        },

        computed: {
            channelOptions() {
                return this.channels.map(c => {
                    return {
                        label: c.name,
                        value: c.id
                    }
                })
            }
        },

        mounted() {
            this.channels = JSON.parse(this.channelsData)
        },

        methods: {
            submit() {
                this.isLoading = true

                this.form
                    .post(route('api.forum.threads.store'))
                    .then(res => {
                        location.href = route('forum.threads.show', res.data.slug)
                    })
                    .catch(err => {
                        this.isLoading = false
                        console.log(err)
                    })
            }
        }
    }
</script>