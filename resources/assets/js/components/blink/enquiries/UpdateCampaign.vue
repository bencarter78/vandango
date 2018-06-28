<template>
    <div>
        <span @click="toggleModal">
            <i class="fa fa-pencil"></i>
        </span>

        <modals-base v-if="showModal">
            <h3 slot="header">Update Enquiry Campaign</h3>

            <div slot="body">
                <form :action="url" method="post">
                    <input type="hidden" name="_token" :value="token">
                    <input type="hidden" name="_method" value="put">

                    <div class="form-group spacer-bottom-3x">
                        <dropdown field-name="campaign_id" :options="campaigns" :value="campaignId"></dropdown>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <input type="submit" class="btn btn-secondary" value="Save">
                    </div>
                </form>
            </div>
        </modals-base>
    </div>
</template>

<script>
    export default {
        mixins: [
            require('../../../mixins/Modal.vue'),
            require('../../../mixins/Form.vue')
        ],

        props: ['campaignId', 'url'],

        data() {
            return {
                showModal: false,
                campaigns: [{label: 'None', value: ''}]
            }
        },

        mounted() {
            this.$http('/api/v1/ignite/campaigns')
                .then(res => res.data.data.forEach(c => this.campaigns.push({label: c.name, value: c.id})))
                .catch(err => console.log(err))
        }
    }
</script>

<style scoped>
    .modal-header h3 {
        margin-top: 0;
        color: #727272;
        font-size: 24px;
        border-bottom: 0;
        padding-bottom: 0;
    }
</style>