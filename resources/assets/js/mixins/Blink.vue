<script>
    export default {
        methods: {
            currentStatus(statuses) {
                return statuses[statuses.length - 1]
            },

            enquiryOwner(owners) {
                return owners[owners.length - 1]
            },

            getContactName(contact) {
                let name = []
                if (contact.first_name) {
                    name.push(contact.first_name)
                }

                if (contact.surname) {
                    name.push(contact.surname)
                }

                return name.join(' ')
            }
        }
    }
</script>