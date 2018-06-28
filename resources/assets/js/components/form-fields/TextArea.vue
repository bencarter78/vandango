<template>
    <div class="has-margin-bottom-3x">
        <div class="form-group" v-bind:class="{'has-error': error}">
            <label v-bind:for="fieldName" v-if="label">
                {{ label }}
                <span v-if="required" class="text-danger">*</span>
            </label>

            <textarea
                    :id="fieldName"
                    :name="fieldName"
                    @input="$emit('input-update', $event)"
                    @blur="$emit('input-blur', $event)"
                    cols="50"
                    rows="10"
                    class="form-control">{{ value }}</textarea>
        </div>
        <span class="text-danger has-margin-top-1x" v-if="error">* Required field</span>
    </div>
</template>

<script>
    export default {
        props: ['fieldName', 'label', 'value', 'required', 'error']
    }
</script>
