<template>
    <modals-base v-if="showModal" @modal-close="$emit('modal-close')" container-classes="modal-container-full-width">
        <div slot="header">
            <h3>{{ data.sector.title }}</h3>
            <ul class="list-inline">
                <li>
                    <i class="fa fa-calendar"></i>
                    <strong>P{{ data.month.period }}</strong>
                    {{ month.format('MMMM') }}
                    {{ month.format('YYYY') }}
                </li>
                <li>
                    <i class="fa fa-users"></i>
                    {{ data.applicants.length }}
                </li>
            </ul>
        </div>

        <div slot="body">
            <v-client-table :data="tableData" :columns="columns" :options="options">

                <template slot="name" slot-scope="props">
                    <a class="is-link" :href="getApplicantUrl(props.row.app.id)">{{ props.row.name }}</a>
                </template>

                <template slot="start" slot-scope="props">
                    {{ props.row.start }}
                    <span v-if="props.row.app.started_on">
                        <i class="fa fa-check-square text-success"></i>
                    </span>
                </template>

                <template slot="adviser" slot-scope="props">
                    <span v-if="props.row.adviser">{{ props.row.adviser }}</span>
                    <span v-else>
                        <a class="is-link" :href="getApplicantUrl(props.row.app.id)">Unassigned</a>
                    </span>
                    <span v-if="props.row.app.adviser_id != props.row.app.user_id">
                        <br>
                        (<small>{{ props.row.user }}</small>)
                    </span>
                </template>

                <template slot="enquiry" slot-scope="props">
                    <actions-link v-if="props.row.enquiry" text="View" :url="props.row.enquiry"></actions-link>
                </template>
            </v-client-table>
        </div>
    </modals-base>
</template>

<script>
    import moment from 'moment'

    export default {
        extends: require('./../DataTable.vue'),
        mixins: [require('./../../mixins/Modal.vue')],
        props: ['data'],
        data() {
            return {
                columns: ['name', 'age', 'type', 'plan', 'organisation', 'start', 'adviser', 'enquiry'],
                options: {
                    columnsClasses: {
                        age: 'text-center',
                        enquiry: 'text-center'
                    },
                    dateColumns: ['start'],
                    dateFormat: 'DD/MM/YYYY',
                    orderBy: {ascending: true, column: 'name'},
                    perPage: 500
                },
                month: moment(this.data.month.start.date)
            }
        },

        created() {
            this.setItems()
        },

        methods: {
            setItems() {
                this.data.applicants.forEach(app => {
                    this.tableData.push({
                        app: app,
                        name: `${app.first_name} ${app.surname}`,
                        age: app.dob ? moment().diff(moment(app.dob), 'years') : '',
                        type: app.programme_type,
                        plan: app.qualification_plan ? app.qualification_plan.description : '',
                        organisation: app.organisation_name ? app.organisation_name : app.enquiry_id ? app.enquiry.contact.organisation.name : '',
                        start: app.started_on ? moment(app.started_on) : moment(app.starting_on),
                        adviser: app.adviser ? `${app.adviser.first_name} ${app.adviser.surname}` : '',
                        user: `${app.user.first_name} ${app.user.surname}`,
                        enquiry: app.enquiry_id ? route('blink.enquiries.edit', app.enquiry_id) : '',
                    })
                })
            },

            getApplicantUrl(id) {
                return route('apply.applicants.edit', id)
            }
        }
    }
</script>