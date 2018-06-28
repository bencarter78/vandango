<template>
    <autocomplete
        field-name="user_id"
        :values="values"
        endpoint="/api/v1/usermanager/users/search"
        :format="format"
        @itemSelected="$emit('itemSelected', $event)">
    </autocomplete>
</template>

<script>
    export default {
        props: ['user', 'user_id'],

        data() {
            return {
                field: ['user_id'],
                values: {
                    id: this.user_id,
                    search: this.user
                },
                format(items) {
                    items.forEach(item => {
                        let department = item.departments.length
                            ? ' - ' + item.departments[0].department
                            : ''

                        item.display = item.first_name + ' ' + item.surname
                        item.resultsDisplay = item.first_name + ' ' + item.surname + department
                    })
                    return items
                }
            }
        },

        methods: {
            getDepartment(user) {
                if (user.departments.length) {
                    return ' - ' + user.departments[0].department
                }
            }
        }
    }
</script>