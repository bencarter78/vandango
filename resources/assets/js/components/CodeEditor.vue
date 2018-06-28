<template>
    <div class="has-margin-bottom-3x">
        <div class="form-group" v-bind:class="{'has-error': error}">
            <label v-if="label" v-bind:for="fieldName">{{ label }}</label>
            <div id="editor"></div>
            <textarea ref="textarea" class="hide form-control sql-query" :name="fieldName" cols="50" rows="10">{{ value }}</textarea>
        </div>
        <span class="text-danger has-margin-top-1x" v-if="error">* Required field</span>
    </div>
</template>

<script>
    var ace = require('brace')
    require('brace/mode/sql')
    require('brace/theme/monokai')

    export default {
        props: ['fieldName', 'label', 'value', 'error'],

        data () {
            return {}
        },

        mounted () {
            var textarea = this.$refs.textarea
            var editor = ace.edit('editor')
            editor.setTheme('ace/theme/monokai')
            editor.getSession().setMode('ace/mode/sql')
            editor.getSession().setValue(textarea.value)
            editor.setOption("showPrintMargin", false)
            editor.container.style.lineHeight = 1.5
            editor.getSession().on('change', function () {
                textarea.value = editor.getSession().getValue()
            })
        }
    }
</script>

<style>
    #editor {
        height: 500px;
    }
</style>