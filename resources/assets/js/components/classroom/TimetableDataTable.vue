<template>
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <div class="pull-right" v-if="hasAccess">
                <a href="/classroom/timetable/create" class="btn btn-secondary"><i class="fa fa-plus"></i> Add</a>
            </div>
            <h4>Timetable</h4>
        </div>

        <div class="panel-body">
            <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
        </div>
    </div>
</template>

<script>
    var DataTable = require('./../DataTable.vue')
    let moment = require('moment')

    export default {
        extends: DataTable,

        props: ['hasAccess'],

        data() {
            return {
                endpoint: '/api/v1/classroom/timetable/' + this.params(),
                modalAction: '/classroom/timetable/',
                columns: ['date', 'time', 'name', 'trainer', 'venue', 'actions'],
                options: {
                    orderBy: {descending: false},
                    heading: {
                        date: 'Date',
                        time: 'time',
                        name: 'Name',
                        trainer: 'Trainer',
                        venue: 'Venue',
                    },
                    templates: {actions: 'resource-actions'}
                }
            }
        },

        methods: {
            params() {
                return this.getParameterByName('expired') ? '?expired=1' : ''
            },

            getParameterByName(name, url) {
                if (!url) {
                    url = window.location.href
                }
                name = name.replace(/[\[\]]/g, "\\$&")
                var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                    results = regex.exec(url)
                if (!results) return null
                if (!results[2]) return ''
                return decodeURIComponent(results[2].replace(/\+/g, " "))
            },

            setItems(timetable) {
                timetable.forEach(t => {
                    var date
                    let startDate = moment(t.starts_at)
                    let endDate = moment(t.ends_at)

                    if (startDate.format('YYYY-MM-DD') == endDate.format('YYYY-MM-DD')) {
                        date = startDate.format('DD/MM/YYYY')
                    } else {
                        date = startDate.format('DD/MM/YYYY') + ' - ' + endDate.format('DD/MM/YYYY')
                    }

                    this.tableData.push({
                        id: t.id,
                        date: date,
                        time: startDate.format('HH:mm') + ' - ' + endDate.format('HH:mm'),
                        name: t.course.name,
                        trainer: t.trainer.first_name + ' ' + t.trainer.surname,
                        venue: t.venue.name + ' ' + t.venue.site.location.town,
                        editUri: '/classroom/timetable/' + t.id + '/edit',
                        showUri: '/classroom/timetable/' + t.id,
                        deleteUri: '/classroom/timetable/' + t.id
                    })
                })
            }
        },
    }
</script>
