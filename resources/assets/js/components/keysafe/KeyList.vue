<template>
    <div id="keys">
        <v-client-table :data="learners" :columns="columns" :options="options"></v-client-table>
    </div>
</template>

<script>
    import DataTable from '../DataTable.vue'

    let moment = require('moment')

    export default {
        extends: DataTable,

        props: ['keys'],

        data () {
            return {
                q: '',
                learners: [],
                columns: ["Key", "IDENT", "Learner", "Email", "Assigned"],
                options: {
                    dateColumns: ['Assigned'],
                    dateFormat: 'DD/MM/YYYY',
                    perPage: 25,
                    highlightMatches: true,
                    texts: {
                        count: '',
                        filterPlaceholder: 'Search...'
                    }
                }
            }
        },

        mounted () {
            let keys = JSON.parse(this.keys)
            for (let i = 0; i < keys.length; i++) {
                this.learners.push({
                    Key: keys[i].key,
                    IDENT: keys[i].ident,
                    Learner: keys[i].first_name + ' ' + keys[i].surname,
                    Email: keys[i].email,
                    Assigned: moment(keys[i].deleted_at)
                })
            }
        }
    }
</script>
