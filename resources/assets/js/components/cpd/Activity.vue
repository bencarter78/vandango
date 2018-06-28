<template>
    <div>
        <errors-default v-if="form.errors.any()" :errors="form.errors.all()"/>

        <form-text-field v-model="form.title" label="Title"/>

        <label for="organisation">Delivery Organisation</label>
        <typeahead class="mb-4"
                   :endpoint="deliverersUri"
                   field-name="organisation"
                   v-model="form.organisation"
                   :format="delivererFormat()"/>

        <form-datepicker :errors="form.errors" v-model="form.starts_on" label="Start Date" :min-date="null"/>

        <form-datepicker :errors="form.errors" v-model="form.ends_on" label="End Date" :min-date="null"/>

        <form-datepicker :errors="form.errors" v-model="form.completed_on" label="Completed Date" :min-date="null" :max-date="moment().toDate()"/>

        <div v-if="form.completed_on">
            <form-text-field v-model="form.total_hours" label="Total CPD Hours"/>
            <form-dropdown v-model="form.grade_id" label="Grade" :options="grades"/>
            <form-text-area v-model="form.reflection" label="What I learnt" class=""/>
            <form-file-upload class="mb-8"
                         label="File Upload"
                         :options="fileUploaderOptions"
                         @success="form.path = $event.response.data.path"/>
        </div>

        <buttons-default :is-loading="isLoading" text="Save" @submit="submit"/>
    </div>
</template>

<script>
    import Form from './../../forms/form'
    import Typeahead from './../Typeahead'
    import moment from 'moment'

    export default {
        components: {Typeahead},

        props: {
            userId: Number,
            activityId: Number
        },

        data() {
            return {
                isLoading: false,
                form: new Form({
                    id: this.activityId,
                    user_id: this.userId,
                    title: '',
                    starts_on: '',
                    ends_on: '',
                    completed_on: '',
                    total_hours: '',
                    grade_id: '',
                    reflection: '',
                    organisation: '',
                    path: ''
                }),
                moment: moment,
                grades: [
                    {value: 1, label: 'Outstanding'},
                    {value: 2, label: 'Good'},
                    {value: 3, label: 'Requires Improvement'},
                    {value: 4, label: 'Unsatisfactory'},
                ],
                fileUploaderOptions: {
                    url: route('api.uploads.store'),
                    params: {user_id: this.userId},
                    maxFiles: 1
                }
            }
        },

        computed: {
            deliverersUri() {
                return route('api.cpd.organisations.search')
            },

            request() {
                return this.activityId
                    ? {method: 'patch', route: route('api.cpd.activities.update', this.activityId)}
                    : {method: 'post', route: route('api.cpd.activities.store')}
            }
        },

        mounted() {
            if (this.activityId) {
                this.fetchActivity()
            }
        },

        methods: {
            fetchActivity() {
                this.$http
                    .get(route('api.cpd.activities.show', this.activityId))
                    .then((res) => {
                        const activity = res.data.data
                        this.form.title = activity.title
                        this.form.starts_on = moment(activity.starts_on).format('DD/MM/YYYY')
                        this.form.ends_on = moment(activity.ends_on).format('DD/MM/YYYY')
                        this.form.completed_on = activity.completed_on ? moment(activity.completed_on).format('DD/MM/YYYY') : ''
                        this.form.total_hours = activity.total_hours
                        this.form.grade_id = activity.grade_id
                        this.form.reflection = activity.reflection
                        this.form.organisation = activity.deliverer.name
                        this.form.path = activity.path
                    })
                    .catch(err => console.log(err))
            },

            submit() {
                this.isLoading = true

                this.form[this.request.method](this.request.route)
                    .then(() => {
                        flash('You have successfully added the activity!')
                        setTimeout(() => location.href = route('cpd.activities.index'), 1000)
                    })
                    .catch(err => {
                        this.isLoading = false
                        console.log(err)
                    })
            },

            delivererFormat() {
                return function (orgs) {
                    return orgs.data.map(o => {
                        return {id: o.id, display: o.name, resultsDisplay: o.name}
                    })
                }
            }
        }
    }
</script>