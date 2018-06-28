<template>
    <div class="" :class="'form-group ' + {'has-error': errors}">
        <form-label :label="label" :for="fieldName" :required="required"></form-label>
        <select v-model="selected"
                :id="fieldName"
                :name="fieldName"
                :class="'form-control ' + inputClass"
                @change="$emit('input', $event.target.value)">
            <option v-if="nullDefaultValue" value="">Please select...</option>
            <option v-for="option in options" :value="option.value" v-text="option.label"></option>
        </select>

        <error-field v-if="errors && errors.has(fieldName)" :error="errors.get(fieldName)"></error-field>
    </div>
</template>

<script>
    import ErrorField from './../../errors/Field'
    import Base from "./Base.vue"

    export default {
        extends: Base,
        components: {ErrorField},

        props: {
            options: {
                type: Array,
                default: []
            },
            nullDefaultValue: {
                default: true
            }
        },

        data() {
            return {
                selected: this.value
            }
        },

        watch: {
            value() {
                this.selected = this.value
            }
        }
    }
</script>
