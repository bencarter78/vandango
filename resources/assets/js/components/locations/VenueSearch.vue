<template>
    <autocomplete
            field-name="room_id"
            :values="values"
            endpoint="/api/v1/locations/search/venues"
            :format="format">
    </autocomplete>
</template>

<script>
    export default {
        props: ['room', 'room_id'],

        data () {
            return {
                values: {
                    id: this.room_id,
                    search: this.room
                },
                format: function (items) {
                    items.forEach(item => {
                        item.display = item.name + ' - ' + item.site.name + ', ' + item.site.location.town
                        item.resultsDisplay = item.display
                    })
                    return items
                }
            }
        }
    }
</script>
