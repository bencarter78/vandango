<template>
    <pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
</template>

<script>
    import {PulseLoader} from 'vue-spinner/dist/vue-spinner.min.js'

    export default {
        props: {
            loading: {
                type: Boolean,
                default: true
            },
            color: {
                type: String,
                default: '#5dc596'
            },
            size: {
                type: String,
                default: '20px'
            },
            radius: {
                type: String,
                default: '100%'
            }
        },

        components: {PulseLoader}
    }
</script>