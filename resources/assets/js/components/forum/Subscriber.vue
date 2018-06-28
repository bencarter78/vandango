<template>
    <span>
        <span v-if="! hasSubscription" class="btn btn-success" @click="subscribe" v-text="subscribeText"/>
        <span v-else class="btn btn-danger" @click="unsubscribe" v-text="unsubscribeText"/>
    </span>
</template>

<script>
    import Form from './../../forms/form'

    export default {
        props: {
            hasSubscribed: Boolean,
            userId: Number,
            url: String,
            subscribeText: {
                type: String,
                default: 'Subscribe'
            },
            unsubscribeText: {
                type: String,
                default: 'Unsubscribe'
            }
        },

        data() {
            return {
                hasSubscription: this.hasSubscribed,
                form: new Form({
                    user_id: this.userId
                }, false)
            }
        },

        methods: {
            subscribe() {
                this.form
                    .post(this.url)
                    .then(() => {
                        this.hasSubscription = true
                        flash('You have subscribed!')
                    })
                    .catch(err => console.log(err))
            },

            unsubscribe() {
                this.form
                    .request('delete', this.url)
                    .then(() => {
                        this.hasSubscription = false
                        flash('You have unsubscribed!')
                    })
                    .catch(err => console.log(err))
            }
        }
    }
</script>

<style scoped>
    span:hover {
        cursor: pointer;
    }
</style>