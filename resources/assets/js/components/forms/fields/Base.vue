<script>
    export default {
        props: {
            inputClass: {
                type: String,
            },
            fieldName: String,
            label: String,
            placeholder: String,
            required: {
                type: Boolean,
                default: false
            },
            errors: {
                type: Object,
                default: null
            },
            addOn: String,
            value: {
                default: ''
            },
            helpText: String
        }
    }
</script>
