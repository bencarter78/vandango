<template>
    <modals-base v-if="showModal">
        <h3 slot="header" class="text-left modal-title">Applicants</h3>

        <div slot="body" class="text-left">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>From</th>
                        <th>English</th>
                        <th>Maths</th>
                        <th>ICT</th>
                    </tr>
                    <tr v-for="app in sortedApplicants">
                        <td>{{ app.name }}</td>
                        <td>{{ app.town }}</td>
                        <td>
                            <ul class="list-unstyled">
                                <span v-if="app.english.length > 0">
                                    <li v-for="grade in app.english">
                                        <i class="fa fa-chevron-circle-right text-success"></i>
                                        {{ grade }}
                                    </li>
                                </span>
                                <li v-else>N/A</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="list-unstyled">
                                <span v-if="app.maths.length > 0">
                                    <li v-for="grade in app.maths">
                                        <i class="fa fa-chevron-circle-right text-success"></i>
                                        {{ grade }}
                                    </li>
                                </span>
                                <li v-else>N/A</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="list-unstyled">
                                <span v-if="app.ict.length > 0">
                                    <li v-for="grade in app.ict">
                                        <i class="fa fa-chevron-circle-right text-success"></i>
                                        {{ grade }}
                                    </li>
                                </span>
                                <li v-else>N/A</li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </modals-base>
</template>

<script>
    export default {
        props: ['applicants'],

        data() {
            return {
                showModal: true
            }
        },

        watch: {
            showModal() {
                this.$emit('toggle')
            }
        },

        computed: {
            sortedApplicants() {
                return this.applicants.sort((a, b) => {
                    return a.name < b.name ? -1 : b.name > a.name ? 1 : 0
                })
            }
        }
    }
</script>

<style scoped>
    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }

    table {
        background-color: transparent;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    tr {
        vertical-align: top;
    }

    td, th {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
</style>
