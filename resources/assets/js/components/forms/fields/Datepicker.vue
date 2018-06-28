<template>
    <div>
        <div :class="'form-group ' + {'has-error': errors.any()}">
            <form-label :label="label" :for="fieldName" :required="required"></form-label>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                <input :id="fieldName"
                       :name="fieldName"
                       :ref="elementRef"
                       :class="'form-control ' + inputClass"
                       :placeholder="placeholder"
                       v-model="value"
                       @input="$emit('input', $event.target.value)"
                       @change="$emit('input', $event.target.value)"/>
            </div>
        </div>

        <error-field v-if="errors && errors.has(fieldName)" :error="errors.get(fieldName)"></error-field>
    </div>
</template>

<script>
    import ErrorField from './../../errors/Field'
    import Base from './Base.vue'
    import moment from 'moment'

    export default {
        extends: Base,
        components: {ErrorField},
        props: {
            elementRef: {
                type: String,
                default: 'pikaday'
            },
            minDate: {
                default: function () {
                    return moment().toDate()
                }
            },
            maxDate: {
                default: function () {
                    return null
                }
            }
        },

        mounted() {
            this.initPicker()
        },

        methods: {
            initPicker() {
                var self = this

                require(['pikaday'], function (Pikaday) {
                    return new Pikaday({
                        field: self.$refs.pikaday,
                        format: 'DD/MM/YYYY',
                        minDate: self.minDate,
                        maxDate: self.maxDate
                    })
                })
            }
        }
    }
</script>

<style src="pikaday/css/pikaday.css"></style>
