<template>
    <div>
        <span class="btn btn-secondary" @click="toggleModal">
            <i class="fa fa-refresh"></i>
            PICS Sync
        </span>

        <modals-base v-if="showModal">
            <h3 slot="header" class="modal-title">Sync With PICS?</h3>

            <div slot="body">
                <p class="spacer-bottom-3x">
                    No match has been made with PICS for this organisation, would you like to attempt a match?
                </p>

                <div v-if="matches">
                    <legend>Matches</legend>

                    <div v-if="matches.length > 0">
                        <div class="alert alert-success" v-if="isSynced">
                            <strong>Good job!</strong>
                            You have successfully synced this organisation to PICS.
                        </div>

                        <ul class="list-group">
                            <li v-for="match in matches" class="list-group-item">
                                <div class="pull-right">
                                    <buttons-default v-if="!isSynced" :is-loading="isSyncing(match.Place)" class="btn btn-secondary" text="Set" @submit="submit(match)"></buttons-default>
                                </div>
                                {{ match.Name }} <br>
                                <small>{{ formatAddress(match.Address) }}</small>
                            </li>
                        </ul>
                    </div>

                    <div v-else>
                        <p>Sorry, no PICS organisations match this organisation's name.</p>
                    </div>
                </div>

                <buttons-default v-if="!matches" :is-loading="isLoading" class="btn btn-secondary" text="Match" @submit="match">
                    Match
                </buttons-default>

            </div>
        </modals-base>
    </div>
</template>

<script>
    export default {
        mixins: [require('../../../mixins/Modal.vue')],
        props: ['organisationId'],

        data() {
            return {
                showModal: false,
                matches: '',
                selected: '',
                isLoading: false,
                isSynced: false
            }
        },

        methods: {
            match() {
                this.isLoading = true
                this.$http
                    .get(route('api.blink.organisations.match.show', this.organisationId))
                    .then(res => {
                        this.matches = res.data.data.results
                        this.isLoading = false
                    })
                    .catch(err => console.log(err))
            },

            formatAddress(address) {
                let data = []
                for (let prop in address) {
                    if (address[prop] != '') {
                        data.push(address[prop])
                    }
                }
                return data.join(', ')
            },

            submit(match) {
                console.log(match)
                this.isLoading = true
                this.selected = match
                this.$http
                    .put(route('api.blink.organisations.match.update', this.organisationId), {organisation: match})
                    .then(res => {
                        console.log(res)
                        this.isSynced = true
                        setInterval(() => window.location.reload(), 1000)
                    })
                    .catch(err => console.log(err))
            },

            isSyncing(ref) {
                return this.selected.Place === ref
            }
        }
    }

</script>