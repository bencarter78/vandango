<template>
    <div class="spacer-top-5x spacer-bottom-5x text-center">
        <pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
    </div>
</template>

<script>
    import {PulseLoader} from 'vue-spinner/dist/vue-spinner.min.js'

    export default {
        props: ['loading', 'color', 'size'],

        components: {PulseLoader}
    }
</script>