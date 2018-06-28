<template>
    <transition name="fade">
        <div :class="classes"
             role="alert"
             v-show="show"
             v-text="body">
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                body: this.message,
                level: 'success',
                show: false
            }
        },

        computed: {
            classes() {
                let defaults = ['flash', 'alert']

                if (this.level === 'success') defaults.push('alert-success')
                if (this.level === 'warning') defaults.push('alert-warning')
                if (this.level === 'danger') defaults.push('alert-danger')

                return defaults
            }
        },

        created() {
            if (this.message) {
                this.flash()
            }

            window.events.$on('flash', data => this.flash(data))
        },

        methods: {
            flash(data) {
                if (data) {
                    this.body = data.message
                    this.level = data.level
                }

                this.show = true

                this.hide()
            },

            hide() {
                setTimeout(() => {
                    this.show = false
                }, 3000)
            }
        }
    }
</script>

<style scoped>
    /*.flash {*/
    /*position: fixed;*/
    /*right: 30px;*/
    /*bottom: 30px;*/
    /*}*/

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
    {
        opacity: 0;
    }
</style>
