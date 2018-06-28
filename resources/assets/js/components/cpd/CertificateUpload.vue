<template>
    <div>
        <errors-default v-if="form.errors.any()" :errors="form.errors.all()" />

        <form-text-field label="Name/Title/Qualification" v-model="form.title" class="mb-4" />
        <form-file-upload class="mb-8" :options="options" @success="form.path = $event.response.data.path"/>
        <buttons-default :is-loading="isLoading" text="Save" @submit="submit"/>
    </div>
</template>

<script>
    import Form from './../../forms/form'

    export default {
        props: {
            userId: Number,
        },

        data() {
            return {
                isLoading: false,
                form: new Form({
                    user_id: this.userId,
                    title: '',
                    path: ''
                }),
                options: {
                    url: route('api.uploads.store'),
                    params: {user_id: this.userId},
                    maxFiles: 1,
                    dictDefaultMessage: 'Drag your certificate here or click to upload'
                }
            }
        },

        methods: {
            submit() {
                this.isLoading = true

                this.form.post(route('api.cpd.certificates.store'))
                    .then(res => {
                        this.isLoading = false
                        this.$emit('success', res.data)
                    })
                    .catch(err => {
                        console.log(err)
                        this.isLoading = false
                    })
            }
        }
    }
</script>