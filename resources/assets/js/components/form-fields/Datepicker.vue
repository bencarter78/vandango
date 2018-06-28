<template>
    <div :class="{'has-error': error}">
        <label :for="fieldName" v-if="label">
            {{ label }}
            <span v-if="required" class="text-danger">*</span>
        </label>

        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <input :id="fieldName" :name="fieldName" ref="pikaday" :value="value" class="form-control" :disabled="disabled" />
        </div>
        <span class="text-danger has-margin-top-1x" v-if="error">* Required field</span>
    </div>
</template>

<script>
    const moment = require('moment')

    export default {
        props: {
            disabled: {default: false},
            error: {default: ''},
            fieldName: {default: ''},
            label: {default: ''},
            maxDate: {
                default() {
                    return null
                }
            },
            minDate: {
                default() {
                    return moment().toDate()
                }
            },
            required: {default: null},
            value: {default: ''},
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
