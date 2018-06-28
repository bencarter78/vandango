<template>
    <div>
        <small class="text-upper is-link" @click="toggleModal">
            Delete
        </small>

        <modals-base v-if="showModal" class="text-left">
            <h3 slot="header">Remove Location</h3>

            <div slot="body" class="text-left">
                <p>Are you sure you want to delete this location?</p>

                <form :action="endpoint" method="post" class="spacer-top-3x">
                    <input type="hidden" name="_token" :value="token">
                    <input type="hidden" name="_method" value="delete">
                    <div class="form-group spacer-bottom-3x">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </modals-base>
    </div>
</template>

<script>
    export default {
        mixins: [
            require('./../../mixins/Form.vue'),
            require('./../../mixins/Modal.vue')
        ],

        props: ['endpoint', 'location'],

        data () {
            return {
                showModal: false,
                item: ''
            }
        },

        created () {
            this.item = JSON.parse(this.location)
        }
    }
</script>