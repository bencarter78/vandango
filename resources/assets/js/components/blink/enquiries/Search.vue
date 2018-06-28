<template>
    <div>
        <loaders-pulse v-if="isLoading" :loading="isLoading"></loaders-pulse>

        <div class="table-responsive" v-if="!isLoading">
            <form-search :value="query" @search="query = $event"/>
            <form-results-count :data-set="dataSet"/>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Organisation</th>
                    <th class="text-center">Opportunities</th>
                    <th class="text-center">Vacancies</th>
                    <th>Owner</th>
                    <th>Updated</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in items">
                    <td>
                        {{ item.contact.first_name }} {{ item.contact.surname }}
                    </td>
                    <td>
                        {{ item.contact.organisation.name }}
                    </td>
                    <td class="text-center">
                        {{ item.opportunities.filter(o => o.deleted_at == null).reduce((carry, item) => carry + parseInt(item.quantity), 0) }}
                    </td>
                    <td class="text-center">
                        {{ item.vacancies.filter(v => v.deleted_at == null).length }}
                    </td>
                    <td>
                        <span v-if="item.current_owner">{{ item.current_owner.full_name }}</span>
                    </td>
                    <td>
                        {{ moment(item.updated_at).fromNow() }}
                    </td>
                    <td class="text-center">
                        <a :href="route(item.id)" class="is-link text-upper">View</a>
                    </td>
                </tr>
                </tbody>
            </table>

            <vd-paginator :data-set="dataSet" @changed="page = $event"/>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    import FormResultsCount from './../../forms/ResultsCount'
    import FormSearch from './../../forms/Search'

    export default {
        components: {
            FormResultsCount, FormSearch
        },

        data() {
            return {
                dataSet: '',
                items: [],
                page: 1,
                query: '',
                isLoading: true,
                sortBy: 'updated_at',
                sortOrder: 'asc'
            }
        },

        watch: {
            page() {
                this.fetch()
            },

            query() {
                this.search()
            }
        },

        mounted() {
            this.fetch()
        },

        methods: {
            fetch() {
                this.isLoading = true

                this.$http
                    .get(route('api.blink.enquiries.search', {
                        page: this.page,
                        q: this.query,
                        sort_by: this.sortBy,
                        sort_order: this.sortOrder
                    }))
                    .then(({data}) => {
                        this.dataSet = data.data
                        this.items = data.data.data
                        this.isLoading = false
                    })
                    .catch(err => console.log(err))
            },

            search() {
                this.page = 1
                history.pushState(null, null, '?page=1')
                this.fetch()
            },

            moment(date) {
                return moment(date)
            },

            route(id) {
                return route('blink.enquiries.edit', id)
            }
        }
    }
</script>