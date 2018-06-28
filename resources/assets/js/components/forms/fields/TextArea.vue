<template>
    <div>
        <div class="" :class="'form-group ' + {'has-error': errors}">
            <form-label :label="label" :for="fieldName" :required="required"></form-label>

            <textarea :value="value"
                      :id="fieldName"
                      :name="fieldName"
                      :class="'form-control ' + inputClass"
                      :placeholder="placeholder"
                      :cols="cols"
                      :rows="rows"
                      @input="$emit('input', $event.target.value)">
            </textarea>
        </div>

        <error-field v-if="errors && errors.has(fieldName)" :error="errors.get(fieldName)"></error-field>
    </div>
</template>

<script>
    import ErrorField from './../../errors/Field'
    import Base from './Base.vue'

    export default {
        extends: Base,
        components: {ErrorField},

        props: {
            cols: {
                type: Number,
                default: 50,
            },
            rows: {
                type: Number,
                default: 10,
            }
        }
    }
</script>
