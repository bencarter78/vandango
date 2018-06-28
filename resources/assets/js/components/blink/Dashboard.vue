<template>
    <div>
        <spinner :loading="isLoading" v-show="isLoading"></spinner>
        <div class="row" v-if="! isLoading">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="text-upper weight-bold">
                            Programme Breakdown
                        </h5>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <th class="text-right">
                                        <!--W/C {{ moment().startOf('week').subtract(1, 'weeks').format('D/M') }}-->
                                    </th>
                                    <th class="text-right">{{ moment().format('MMM') }}</th>
                                    <th class="text-right">YTD</th>
                                    <th class="text-right">PICS</th>
                                </tr>
                                <tr v-for="status in data.statuses">
                                    <td>{{ status.name }}</td>
                                    <td class="text-right">
                                        {{ programmeTotals(programme, data.programmesWeekly) }}
                                    </td>
                                    <td class="text-right">
                                        {{ programmeTotals(programme, data.programmesMonthly) }}
                                    </td>
                                    <td class="text-right">{{ programme.total }}</td>
                                    <td class="text-right">
                                        {{ programmeTotals(programme, data.programmesPics) }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="text-upper weight-bold">
                        <span class="badge pull-right">
                            {{ moment().startOf('week').subtract(1, 'weeks').format('DD/MM') }} -
                            {{ moment().subtract(1, 'weeks').endOf('week').format('DD/MM') }}
                        </span>
                            Weekly Entries
                        </h5>
                    </div>
                    <div class="panel-body">
                        <div class="overflow">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr v-for="sector in data.weeklySectors">
                                        <td>
                                            <span class="text-gray-lighter">{{ sector.code }}</span>
                                        </td>
                                        <td>{{ sector.name }}</td>
                                        <td class="text-right">
                                            {{ sector.total }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="text-upper weight-bold">
                        <span class="badge pull-right">
                        {{ moment().format('MMM') }}
                        </span>
                            Monthly Entries
                        </h5>
                    </div>
                    <div class="panel-body">
                        <div class="overflow">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr v-for="sector in data.monthlySectors">
                                        <td>
                                            <span class="text-gray-lighter">{{ sector.code }}</span>
                                        </td>
                                        <td>{{ sector.name }}</td>
                                        <td class="text-right">
                                            {{ sector.total }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <small class="pull-right">
                            <a href="/apply/applicants/create" class="btn btn-success btn-sm">
                                <i class="fa fa-plus"></i>
                                Add
                            </a>
                        </small>
                        <h5 class="text-upper weight-bold">
                            Apply Entries
                        </h5>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Last Week</td>
                                    <td class="text-right">
                                        <ul class="list-inline">
                                            <li>
                                                {{ data.lastWeekCount }}
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>This Week</td>
                                    <td class="text-right">
                                        <ul class="list-inline">
                                            <li>
                                                <small :class="differenceClass(data.weeklyCount, data.lastWeekCount)">
                                                    {{ data.weeklyCount - data.lastWeekCount }}
                                                    <i v-if="data.weeklyCount - data.lastWeekCount >= 0" class="fa fa-long-arrow-up"></i>
                                                    <i v-else class="fa fa-long-arrow-down"></i>
                                                </small>
                                            </li>
                                            <li>
                                                {{ data.weeklyCount }}
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ moment().format('MMMM') }}</td>
                                    <td class="text-right">
                                        <ul class="list-inline">
                                            <li>
                                                <small :class="differenceClass(data.monthlyCount, data.lastMonthCount)">
                                                    {{ data.monthlyCount - data.lastMonthCount }}
                                                    <i v-if="data.monthlyCount - data.lastMonthCount >= 0" class="fa fa-long-arrow-up"></i>
                                                    <i v-else class="fa fa-long-arrow-down"></i>
                                                </small>
                                            </li>
                                            <li>
                                                {{ data.monthlyCount }}
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <a class="pull-right btn btn-sm btn-primary" href="/apply/sectors">
                                VIEW ALL
                            </a>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="text-upper weight-bold">
                            <small class="badge badge-primary pull-right">{{ moment().format('MMM') }}</small>
                            Top Entries
                        </h5>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th colspan="2">
                                        <span class="text-gray-lighter">SECTOR</span>
                                    </th>
                                </tr>
                                <tr v-for="sector in data.sectors">
                                    <td>{{ sector.name }}</td>
                                    <td class="text-right">{{ sector.total }}</td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table">
                                <tbody>
                                <tr>
                                    <th colspan="2">
                                        <span class="text-gray-lighter">STAFF</span>
                                    </th>
                                </tr>
                                <tr v-for="user in data.users">
                                    <td>{{ user.name }}</td>
                                    <td class="text-right">{{ user.total }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="text-upper weight-bold">
                            <small class="badge badge-primary pull-right">{{ moment().format('MMM') }}</small>
                            Top Converted Starts
                        </h5>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th colspan="2">
                                        <span class="text-gray-lighter">SECTOR</span>
                                    </th>
                                </tr>
                                <tr v-for="sector in data.picsSectors">
                                    <td>{{ sector.name }}</td>
                                    <td class="text-right">{{ sector.total }}</td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table">
                                <tbody>
                                <tr>
                                    <th colspan="2">
                                        <span class="text-gray-lighter">STAFF</span>
                                    </th>
                                </tr>
                                <tr v-for="user in data.picsUsers">
                                    <td>{{ user.name }}</td>
                                    <td class="text-right">{{ user.total }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="text-upper weight-bold">
                            <small class="badge pull-right">
                                01/08 - {{ moment().subtract(4, 'weeks').format('DD/MM') }}
                            </small>
                            Most Unconverted Starts
                        </h5>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr v-for="sector in data.unconverted">
                                    <td>{{ sector.name }}</td>
                                    <td class="text-right">{{ sector.total }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const moment = require('moment')

    export default {
        data() {
            return {
                data: [],
                moment: moment,
                isLoading: true
            }
        },

        mounted() {
            this.fetchData()
        },

        methods: {
            fetchData() {
                this.$http
                    .get('/api/v1/blink/dashboard')
                    .then(res => {
                        this.data = res.data.data
                        this.isLoading = false
                    })
                    .catch(err => console.log(err))
            },

            differenceClass(a, b) {
                return a - b >= 0 ? 'text-success' : 'text-danger'
            },

            programmeTotals(programme, data) {
                let count = data.filter(p => {
                    return p.name == programme.name
                })

                return (count.length > 0) ? count[0].total : 0
            }
        }
    }
</script>