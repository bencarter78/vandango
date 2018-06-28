<template>
    <div v-if="error" class="text-danger weight-bold spacer-top">
        <i class="fa fa-warning"></i>
        {{ error }}
    </div>
</template>

<script>
    export default {
        props: ['error']
    }
</script>