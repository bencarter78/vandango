<template>
    <div>
        <div class="" :class="'form-group ' + {'has-error': errors}">
            <form-label :label="label" :for="fieldName" :required="required"></form-label>

            <p v-if="helpText" class="font-size-small" v-text="helpText"></p>

            <input type="hidden" id="trix" :name="fieldName"/>

            <trix-editor
                ref="trix"
                input="trix"
                :placeholder="placeholder"
                @trix-change="$emit('input', $event.target.value)"/>
        </div>

        <error-field v-if="errors && errors.has(fieldName)" :error="errors.get(fieldName)"></error-field>
    </div>
</template>

<script>
    import trix from 'trix'
    import ErrorField from './../../errors/Field'
    import Base from "./Base.vue"

    export default {
        extends: Base,
        components: {ErrorField},

        props: {
            reset: Boolean
        },

        data() {
            return {
                content: this.value,
            }
        },

        watch: {
            reset() {
                if (this.reset) {
                    this.$refs.trix.innerHTML = ''
                    this.$refs.trix.blur()
                }
            }
        }
    }
</script>

<style>
    trix-editor {
        min-height: 15em;
    }
</style>