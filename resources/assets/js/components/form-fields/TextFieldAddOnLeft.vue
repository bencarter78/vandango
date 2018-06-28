<template>
    <div class="has-margin-bottom-3x">
        <div class="form-group" v-bind:class="{'has-error': error}">
            <label v-bind:for="fieldName" v-if="label">
                {{ label }}
                <span v-if="required" class="text-danger">*</span>
            </label>

            <div class="input-group">
                <span class="input-group-addon">
                    <i :class="'fa ' + icon"></i>
                </span>
                <input
                    type="text"
                    :name="fieldName"
                    :id="fieldName"
                    class="form-control"
                    :value="value">
            </div>
        </div>
        <span class="text-danger has-margin-top-1x" v-if="error">* Required field</span>
    </div>
</template>

<script>
    export default {
        props: ['fieldName', 'label', 'value', 'error', 'required', 'icon']
    }
</script>
