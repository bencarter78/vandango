<template>
    <div>
        <div :class="'form-group ' + {'has-error': errors}">
            <form-label :label="label" :for="fieldName" :required="required"></form-label>

            <input type="text"
                   :id="fieldName"
                   :name="fieldName"
                   :class="'form-control ' + inputClass"
                   :placeholder="placeholder"
                   v-model="inputValue"
                   @input="$emit('input', $event.target.value)">

            <error-field v-if="errors && errors.has(fieldName)" :error="errors.get(fieldName)"></error-field>
        </div>
    </div>
</template>

<script>
    import ErrorField from './../../errors/Field'
    import Base from "./Base.vue"

    export default {
        extends: Base,
        components: {ErrorField},

        data() {
            return {
                inputValue: this.value
            }
        },

        watch: {
            value() {
                this.inputValue = this.value
            }
        }
    }
</script>
