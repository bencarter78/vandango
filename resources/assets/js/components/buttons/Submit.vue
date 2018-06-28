<template>
    <span class="btn btn-success" @click="$emit('submit')">
        <span v-if="! isLoading">SAVE</span>
        <span v-else>SAVING...<loaders-clip size="20px" color="#ffffff"></loaders-clip></span>
    </span>
</template>

<script>
    /**
     * @deprecated Use buttons/Default.vue
     */
    export default {
        props: ['isLoading']
    }
</script>
