<template>
    <div>
        <h4 class="spacer-bottom-3x">Leave A Reply</h4>

        <form-text-editor
            v-model="form.body"
            :errors="form.errors"
            :reset="resetEditor"
            field-name="body"
            placeholder="Have something to say?"
            @input="resetEditor = false"/>

        <buttons-default :isLoading="isLoading" class="spacer-top-x" text="Save" @submit="submit"></buttons-default>
    </div>
</template>

<script>
    import Form from './../../forms/form'

    export default {
        props: {
            userId: Number,
            threadSlug: String
        },

        data() {
            return {
                form: new Form({
                    user_id: this.userId,
                    body: ''
                }),
                resetEditor: false,
                isLoading: false
            }
        },

        methods: {
            submit() {
                this.isLoading = true

                this.form
                    .post(route('api.forum.threads.replies.store', this.threadSlug))
                    .then(res => this.onSuccess(res))
                    .catch(err => {
                        this.isLoading = false
                        console.log(err.response)
                    })
            },

            onSuccess(res) {
                this.isLoading = false
                this.$emit('created', res.data)
                this.resetForm()
                flash('You have added a reply!')
            },

            resetForm() {
                this.form.user_id = this.userId
                this.form.body = ''
                this.resetEditor = true
            }
        }
    }
</script>