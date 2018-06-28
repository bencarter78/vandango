<template>
    <modals-base v-if="showModal">
        <h3 slot="header">Add Location</h3>

        <div slot="body" class="text-left">
            <form :action="locationEndpoint" method="post">
                <input type="hidden" name="_token" :value="token">

                <div class="form-group spacer-bottom-3x">
                    <text-field field-name="add1" label="Street Address"></text-field>
                </div>

                <div class="form-group spacer-bottom-3x">
                    <text-field field-name="add2" label="Address Line 2"></text-field>
                </div>

                <div class="form-group spacer-bottom-3x">
                    <text-field field-name="add3" label="Address Line 3"></text-field>
                </div>

                <div class="form-group spacer-bottom-3x">
                    <text-field field-name="town" label="Town"></text-field>
                </div>

                <div class="form-group spacer-bottom-3x">
                    <text-field field-name="county" label="County"></text-field>
                </div>

                <div class="form-group spacer-bottom-3x">
                    <text-field field-name="postcode" label="Post Code"></text-field>
                </div>

                <div class="form-group spacer-bottom-3x">
                    <input type="submit" class="btn btn-secondary" value="Save">
                </div>
            </form>
        </div>
    </modals-base>
</template>

<script>
    export default {
        mixins: [
            require('./../../mixins/Form.vue'),
            require('./../../mixins/Modal.vue')
        ],

        props: ['locationEndpoint']
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