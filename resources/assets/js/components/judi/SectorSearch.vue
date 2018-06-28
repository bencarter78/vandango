<template>
    <div>
        <div class="row spacer-bottom-1x">
            <div class="col-md-12">
                <div class="well">
                    <input id="search-filter" type="text" class="form-control" placeholder="Filter sectors" v-model="search"/>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h4>Sector PA Schedule</h4></div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tbody>
                    <tr>
                        <th>Sector</th>
                        <th class="text-center">PA Month</th>
                        <th class="text-center" v-if="hasAccess == true">Actions</th>
                    </tr>
                    <tr v-for="sector in orderedItems">
                        <td><a v-bind:href="'/judi/sectors/' + sector.id">{{ sector.name }}</a></td>
                        <td class="text-center">
                            <span>{{ sector.paMonth }}</span>
                        </td>
                        <td class="text-center" v-if="hasAccess == true">
                            <div class="actions">
                                <a class="btn btn-primary btn-circle" v-bind:href="'/judi/sectors/' + sector.id + '/edit'"><i class="fa fa-pencil"></i></a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import Helpers from '../../libs/Helpers'
    var moment = require('moment');

    export default {
        props: ['hasAccess', 'user'],

        data () {
            return {
                search: '',
                order: 1,
                sectors: [],
            }
        },

        computed: {
            filteredItems: function () {
                return Helpers.filterBy(this.sectors, this.search, 'name')
            },

            orderedItems: function () {
                return Helpers.orderBy(this.filteredItems, 'name')
            }
        },

        mounted () {
            var self = this
            axios.get('/api/v1/judi/sectors', {
                params: {user: self.user}
            })
                 .then(function (response) {
                     self.setSectors(response.data);
                 })
                 .catch(function (err) {
                     console.log(err);
                 })
        },

        methods: {
            getMonth (month){
                if (month == '0') {
                    return '';
                }
                return moment(month, 'MM').format('MMMM');
            },

            setSectors (sectors){
                sectors.forEach(sector => {
                    var sectorMonth = '';
                    if (sector.schedule) {
                        sectorMonth = this.getMonth(sector.schedule.month);
                    }

                    this.sectors.push({
                        id: sector.id,
                        name: sector.name,
                        paMonth: sectorMonth
                    });
                })
            }
        },
    };
</script>
