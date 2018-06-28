<template>
    <autocomplete
            field-name="organisation_id"
            :values="values"
            endpoint="/api/v1/blink/organisations"
            :format="format"
            v-on:itemSelected="setItem">
    </autocomplete>
</template>

<script>
    export default {
        props: ['organisation'],

        data() {
            return {
                format: function (items) {
                    items.results.forEach(item => {
                        item.display = item.name
                        item.resultsDisplay = item.name
                    })
                    return items.results
                }
            }
        },

        computed: {
            values () {
                return {
                    id: this.organisation.id,
                    search: this.organisation.name
                }
            }
        },

        methods: {
            setItem (item) {
                this.$emit('organisationSelected', item)
            }
        }
    }
</script>