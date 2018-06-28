<template>
    <autocomplete
            field-name="contact_id"
            :values="values"
            :endpoint="endpoint"
            :format="format"
            v-on:itemSelected="setItem">
    </autocomplete>
</template>

<script>
    export default {
        props: ['contact', 'endpoint'],

        data() {
            return {
                values: {
                    id: this.contact.id,
                    search: this.contact.name
                },

                format: function (items) {
                    items.results.forEach(item => {
                        var organisation = item.organisation ? ' - ' + item.organisation.name : ''
                        item.display = item.first_name + ' ' + item.surname
                        item.resultsDisplay = item.first_name + ' ' + item.surname + organisation
                    })
                    return items.results
                }
            }
        },

        methods: {
            setItem (item) {
                this.$emit('contactSelected', item)
            }
        }
    }
</script>