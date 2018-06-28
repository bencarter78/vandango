<template>
    <div>
        <div v-bind:class="{'has-error': error}">
            <label v-bind:for="fieldName" v-if="label">
                {{ label }}
                <span v-if="required" class="text-danger">*</span>
            </label>

            <select :id="fieldName" :name="fieldName" class="form-control" @change="$emit('has-updated', $event.target.value)">
                <option v-if="nullDefaultValue" value="">Please select...</option>
                <option v-for="option in options" :value="option.value" v-bind:selected="isSelected(option.value)">
                    {{ option.label }}
                </option>
            </select>
        </div>
        <span class="text-danger has-margin-top-1x" v-if="error">* Required field</span>
    </div>
</template>

<script>
    export default {
        props: {
            fieldName: {default: ''},
            label: {default: ''},
            value: {default: ''},
            options: {default: ''},
            required: {default: ''},
            error: {default: ''},
            nullDefaultValue: {default: true}
        },

        methods: {
            isSelected (value) {
                if (this.value == value) {
                    return 'selected'
                }
            }
        }
    }
</script>
