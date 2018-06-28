<template>
    <div>
        <span @click="toggleModal">
            <i class="fa fa-pencil"></i>
        </span>

        <modals-base v-if="showModal">
            <h3 slot="header">Update Application Manager</h3>

            <div slot="body">
                <form :action="url" method="post">
                    <input type="hidden" name="_token" :value="token">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="updated_by" :value="updatedBy">

                    <div class="form-group spacer-bottom-3x">
                        <search-users></search-users>
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

        props: ['nasRef', 'url', 'updatedBy'],

        data() {
            return {
                showModal: false
            }
        }
    }
</script>