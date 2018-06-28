<template>
    <a :class="classes" :href="url" v-text="text"></a>
</template>

<script>
    export default {
        props: {
            url: {default: ''},
            text: {default: 'View'},
            classes: {default: 'font-size-small text-upper is-link'}
        }
    }
</script>