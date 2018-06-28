<template>
    <clip-loader :loading="loading" :color="color" :size="size"></clip-loader>
</template>

<script>
    import ClipLoader from 'vue-spinner/src/ClipLoader.vue'

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

        components: {
            ClipLoader
        }
    }
</script>