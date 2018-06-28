<template>
    <span>
        <loaders-clip :loading="isLoading" v-if="isLoading"></loaders-clip>

        <a @click="showModal = true" class="is-link">
            {{ total }}
        </a>

        <ava-vacancy-applicants-overview v-if="showModal" @toggle="showModal = false" :applicants="applicants">
        </ava-vacancy-applicants-overview>
    </span>
</template>

<script>
    import Helper from './../../libs/Helpers'

    export default {
        props: ['nasRef'],

        data() {
            return {
                applicants: [],
                applications: [],
                isLoading: true,
                showModal: false,
                total: ''
            }
        },

        mounted() {
            this.getApplications()
        },

        methods: {
            getApplications() {
                setTimeout(() => {
                    this.$http
                        .get(route('api.blink.vacancies.applications', this.nasRef))
                        .then(res => {
                            this.isLoading = false
                            this.total = res.data.data.total
                            this.applications = res.data.data.vacancy.applications
                            this.applications.forEach(app => {
                                let grades = this.getGrades(app.applicant.qualifications, res.data.data.vacancy.id)
                                this.applicants.push({
                                    name: Helper.titleCase(app.applicant.first_name + ' ' + app.applicant.surname),
                                    town: this.getLocation(app.applicant.address[app.applicant.address.length - 1]),
                                    maths: grades.maths,
                                    english: grades.english,
                                    ict: grades.ict
                                })
                            })
                        })
                        .catch(err => {
                            console.log(err)
                            this.isLoading = false
                        })
                }, Math.floor(Math.random() * 5) * 1000)
            },

            getGrades(quals, id) {
                let grades = {
                    english: [],
                    ict: [],
                    maths: []
                }

                quals.filter(q => q.vacancy_id == id)
                     .forEach(q => {
                         if (q.subject.toLowerCase().includes('math')) {
                             grades.maths.push([[q.qualification, q.subject].join(' '), q.grade.toUpperCase()].join(': '))
                         }

                         if (q.subject.toLowerCase().includes('english')) {
                             grades.english.push([[q.qualification, q.subject].join(' '), q.grade.toUpperCase()].join(': '))
                         }

                         if (q.subject.toLowerCase().includes('it ')
                             || q.subject.toLowerCase().includes('ict ')
                             || q.subject.toLowerCase().includes('i.t.')
                             || q.subject.toLowerCase().includes('i.c.t.')) {
                             grades.ict.push([[q.qualification, q.subject].join(' '), q.grade.toUpperCase()].join(': '))
                         }
                     })

                return grades
            },

            getLocation (address) {
                if (address.town) {
                    return address.town
                }

                return address.county
            }
        }
    }
</script>