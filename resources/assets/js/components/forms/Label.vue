<template>
    <label v-if="label" :for="fieldName" v-text="label">
        <span v-if="required" class="text-danger">*</span>
    </label>
</template>

<script>
    export default {
        props: ['label', 'fieldName', 'required']
    }
</script>