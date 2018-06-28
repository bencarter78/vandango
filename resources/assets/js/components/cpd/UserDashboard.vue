<template>
    <div class="row">
        <div class="col-md-3">
            <div class="mb-20">
                <div class="flex border-blue pb-1 mb-4 font-bold border-b-4 font-size-larger uppercase">
                    <div class="flex-1">Activity Overview</div>
                    <div class="flex bg-green rounded-full h-10 w-10 items-center justify-center text-white font-size-smallest cursor-pointer" @click="addActivity">
                        <i class="fa fa-plus"></i>
                    </div>
                </div>
                <div class="flex mb-4 border-b-2 border-grey-light pb-2">
                    <div class="flex-1">{{ currentYear }} Hours</div>
                    <div class="flex-1 font-semibold text-blue text-right">{{ calculateHours(activitiesInYear) }}</div>
                </div>
                <div class="flex mb-4 border-b-2 border-grey-light pb-2">
                    <div class="flex-1">{{ currentYear }} Activities</div>
                    <div class="flex-1 font-semibold text-blue text-right">{{ activitiesInYear.length }}</div>
                </div>
                <div class="flex mb-4 border-b-2 border-grey-light pb-2">
                    <div class="flex-1">All Time Hours</div>
                    <div class="flex-1 font-semibold text-blue text-right">{{ calculateHours(activities) }}</div>
                </div>
                <div class="flex mb-4 border-b-2 border-grey-light pb-2">
                    <div class="flex-1">All Time Activities</div>
                    <div class="flex-1 font-semibold text-blue text-right">{{ activities.length }}</div>
                </div>
            </div>

            <div class="mb-20">
                <div class="flex border-blue pb-1 mb-4 font-bold border-b-4 font-size-larger uppercase">
                    <div class="flex-1">CV</div>
                    <div class="flex bg-green rounded-full h-10 w-10 items-center justify-center text-white font-size-smallest cursor-pointer" @click="cvModal = true">
                        <i class="fa fa-plus"></i>
                    </div>
                </div>
                <div v-if="cv.path" class="flex mb-4 border-b-2 border-grey-light pb-2">
                    <div class="flex-1">{{ user.full_name }}</div>
                    <div class="flex-1 font-semibold text-blue text-right">
                        <a v-if="cv.path" :href="downloadPath(cv.path)">
                            <i class="fa fa-download"></i>
                        </a>
                    </div>
                </div>
                <div v-else class="italic text-gray-light">
                    Please upload your CV
                </div>
            </div>

            <div class="mb-8">
                <div class="flex border-blue pb-1 mb-4 font-bold border-b-4 font-size-larger uppercase">
                    <div class="flex-1">Certificates</div>
                    <div class="flex bg-green rounded-full h-10 w-10 items-center justify-center text-white font-size-smallest cursor-pointer" @click="certificateModal = true">
                        <i class="fa fa-plus"></i>
                    </div>
                </div>

                <div v-if="certificates.length > 0">
                    <div v-for="cert in certificates" class="flex mb-4 border-b-2 border-grey-light pb-2">
                        <div class="flex-1">{{ cert.title }}</div>
                        <div class="flex-1 font-semibold text-blue text-right">
                            <a v-if="cert.path" :href="downloadPath(cert.path)">
                                <i class="fa fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div v-else class="italic text-gray-light">
                    Please upload your certificates
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <cpd-activity-data-table :user-id="user.id" @loaded="activities = $event"/>
        </div>

        <modals-base v-if="cvModal" @modal-close="cvModal = false">
            <h3 slot="header" class="modal-title">Upload Your CV</h3>

            <div slot="body">
                <cpd-cv-upload :user-id="user.id" @success="updateCv"/>
            </div>
        </modals-base>

        <modals-base v-if="certificateModal" @modal-close="certificateModal = false">
            <h3 slot="header" class="modal-title">Upload Your Certificate</h3>

            <div slot="body">
                <cpd-certificates-upload :user-id="user.id" @success="addCertificate"/>
            </div>
        </modals-base>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        props: {
            user: Object,
            contractYear: Array,
        },

        data() {
            return {
                activities: [],
                certificates: this.user.certificates,
                cv: this.user.cv ? this.user.cv : {path: ''},
                cvModal: false,
                certificateModal: false
            }
        },

        computed: {
            currentYear() {
                return [
                    moment(this.contractYear[0].date).format('YY'),
                    '/',
                    moment(this.contractYear[1].date).format('YY')
                ].join('')
            },

            activitiesInYear() {
                return this.activities.filter(a => {
                    return moment(a.starts_on).isBetween(moment(this.contractYear[0].date), moment(this.contractYear[1].date), 'day', '[]')
                })
            }
        },

        methods: {
            calculateHours(activities) {
                return activities.reduce((carry, item) => carry + parseInt(item.total_hours), 0)
            },

            downloadPath(path) {
                return route('api.uploads.index') + '?path=' + path
            },

            updateCv(path) {
                this.cv.path = path
                this.cvModal = false
                flash('You have successfully updated your CV')
            },

            addCertificate(certificate) {
                this.certificates.push(certificate)
                this.certificateModal = false
                flash('You have successfully added your certificate')
            },

            addActivity() {
                location.href = route('cpd.activities.create')
            },
        }
    }
</script>