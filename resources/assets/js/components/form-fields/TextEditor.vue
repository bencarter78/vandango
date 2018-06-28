<template>
    <div>
        <div v-bind:class="{'has-error': error}">
            <label v-bind:for="fieldName" v-if="label">
                {{ label }}
                <span v-if="required" class="text-danger">*</span>
            </label>

            <p v-if="helpText" class="font-size-small">
                {{ helpText }}
            </p>
            <input type="hidden" :id="fieldName" :name="fieldName" :value="content"/>
            <trix-editor :input="fieldName"></trix-editor>
        </div>
        <span class="text-danger has-margin-top-1x" v-if="error">* Required field</span>
    </div>
</template>

<script>
    import trix from 'trix'

    export default {
        props: ['fieldName', 'helpText', 'label', 'value', 'required', 'error'],

        data() {
            return {
                content: this.value,
            }
        }
    }
</script>