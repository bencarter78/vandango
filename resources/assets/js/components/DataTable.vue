<script>
    var Vue = require('vue')
    import {ClientTable, Event} from 'vue-tables-2'

    Vue.use(ClientTable)

    export default {
        props: ['hasAccess'],

        data() {
            return {
                tableData: [],
                options: {
                    perPage: 25,
                    highlightMatches: true,
                    texts: {
                        // count: '',
                        filterPlaceholder: 'Search...'
                    },
                    sortIcon: {
                        base: 'glyphicon',
                        up: 'spacer-left-1x glyphicon-chevron-up',
                        down: 'spacer-left-1x glyphicon-chevron-down',
                        is: ''
                    },
                    columnsClasses: {
                        actions: 'text-center',
                    }
                }
            }
        },

        mounted() {
            if (this.endpoint) {
                this.$http
                    .get(this.endpoint)
                    .then(res => this.setItems(res.data))
                    .catch((err) => console.log(err))
            }
        },

        methods: {
            getMemberships(items, key) {
                let html = []
                this.sort(items, key).forEach(item => html.push(item[key]))
                return html.join(", ")
            },

            sort(items, key) {
                return items.sort(function (a, b) {
                    if (a[key] < b[key]) return -1
                    if (a[key] > b[key]) return 1
                    return 0
                })
            },

            deleteModal(model) {
                return ''
            }
        }
    }
</script>
