<template>
    <div v-if="errors && errors[error]" class="text-danger spacer-top-1x">{{ errors[error][0] }}</div>
</template>

<script>
    export default {
        props: ['error']
    }
</script>