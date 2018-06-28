<template>
    <span :class="'text-upper btn ' + (classes || 'btn-success')" @click="$emit('submit')">
        <span v-if="! isLoading">{{ text }}</span>
        <span v-else>{{ loadingText }}<loaders-clip size="20px" color="#ffffff"></loaders-clip></span>
    </span>
</template>

<script>
    export default {
        props: ['classes', 'text', 'loadingText', 'isLoading']
    }
</script>
