<template>
    <div v-if="hasEnquiries" class="alert alert-info">
        <p>
            <i class="fa fa-warning"></i>
            {{ organisation.name }} already has a live enquiry. Please ensure the enquiry you are adding is not a
            duplicate of the existing one before adding it.
        </p>

        <div class="table-responsive spacer-top-3x">
            <table class="table">
                <tr>
                    <th>Contact</th>
                    <th class="text-center">Opportunities</th>
                    <th class="text-center">Vacancies</th>
                    <th class="text-center">Named Starts</th>
                    <th>Created</th>
                    <th>Owner</th>
                </tr>
                <tr v-for="e in enquiries">
                    <td>{{ e.contact.first_name }} {{ e.contact.surname }}</td>
                    <td class="text-center">{{ getOpportunityTotal(e.opportunities) }}</td>
                    <td class="text-center">{{ getVacancyTotal(e.vacancies) }}</td>
                    <td class="text-center">{{ getApplicantsTotal(e.applicants) }}</td>
                    <td>{{ moment(e.created_at).format('DD/MM/YYYY') }}</td>
                    <td>{{ getOwner(e.owners) }}</td>
                    <td>
                        <a class="is-link text-upper" :href="getUri(e)">View</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        mixins: [require('../../../mixins/Date.vue')],
        props: ['organisationId'],

        data() {
            return {
                organisation: '',
                enquiries: '',
                hasEnquiries: false
            }
        },

        watch: {
            organisationId() {
                this.fetch()
            }
        },

        methods: {
            fetch() {
                this.$http
                    .get(route('api.blink.organisations.enquiries.index', {
                        id: this.organisationId
                    }))
                    .then(res => {
                        console.log(res)
                        this.hasEnquiries = true
                        this.organisation = res.data.data
                        this.enquiries = res.data.data.enquiries
                    })
                    .catch(err => console.log(err))
            },

            getOpportunityTotal(opportunities) {
                return opportunities
                    .filter(o => o.deleted_at == null)
                    .reduce((carry, item) => carry + parseInt(item.quantity), 0)
            },

            getVacancyTotal(vacancies) {
                return vacancies.filter(v => v.deleted_at == null).length
            },

            getApplicantsTotal(applicants) {
                return applicants.filter(v => v.deleted_at == null).length
            },

            getOwner(owners) {
                let owner = owners[owners.length - 1]
                return [owner.first_name, owner.surname].join(' ')
            },

            getUri(enquiry) {
                return route('blink.enquiries.edit', enquiry.id)
            }
        }
    }
</script>