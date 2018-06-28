<script>
    export default {
        data() {
            return {
                showModal: true
            }
        },

        watch: {
            showModal() {
                this.$emit('toggle')
            }
        },

        methods: {
            toggleModal() {
                this.showModal = !this.showModal
            },

            modalScrollTop() {
                document.getElementsByClassName('modal-container')[0].scrollTop = 0
            }
        }
    }
</script>