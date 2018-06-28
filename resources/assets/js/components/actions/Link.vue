<template>
    <a :class="classes" :href="url" v-text="text" @click="$emit('click')"></a>
</template>

<script>
    export default {
        props: {
            url: {default: ''},
            text: {default: ''},
            classes: {default: 'font-size-small text-upper is-link'}
        }
    }
</script>