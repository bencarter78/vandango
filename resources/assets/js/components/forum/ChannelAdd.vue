<template>
    <div>
        <errors-default v-if="form.errors.any()" :errors="form.errors.all()"></errors-default>

        <div class="spacer-bottom-3x">
            <form-text-field v-model="form.name" label="Name"></form-text-field>
        </div>

        <buttons-default :isLoading="isLoading" text="Save" @submit="submit"></buttons-default>
    </div>
</template>

<script>
    import Form from './../../forms/form'

    export default {
        data() {
            return {
                isLoading: false,
                form: new Form({
                    name: ''
                })
            }
        },

        methods: {
            submit() {
                this.isLoading = true

                this.form
                    .post(route('api.forum.channels.store'))
                    .then(() => {
                        this.isLoading = false
                        this.form.reset()
                        flash("You have successfully added a new channel!")
                    })
                    .catch(err => {
                        this.isLoading = false
                        console.log(err)
                    })
            }
        }
    }
</script>