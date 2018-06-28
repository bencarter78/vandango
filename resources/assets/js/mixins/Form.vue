<script>
    export default {
        data() {
            return {
                isLoading: false,
                formData: new FormData(),
                errors: null,
                token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },

        methods: {
            buildOptions(data, value, label, options = [{value: '', label: 'Please select...'}]) {
                data.forEach(d => options.push({value: d[value], label: d[label]}))
                return options
            },

            toggleLoadingState() {
                this.isLoading = !this.isLoading
            },

            resetErrors() {
                this.errors = null
            }
        }
    }
</script>