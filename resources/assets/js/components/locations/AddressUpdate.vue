<template>
    <div>
        <small class="text-upper is-link" @click="toggleModal">
            Edit
        </small>

        <modals-base v-if="showModal">
            <h3 slot="header">Update Location</h3>

            <div slot="body" class="text-left">
                <form :action="endpoint" method="post">
                    <input type="hidden" name="_token" :value="token">
                    <input type="hidden" name="_method" value="put">

                    <div class="form-group spacer-bottom-3x">
                        <text-field field-name="add1" label="Street Address" :value="item.add1"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <text-field field-name="add2" label="Address Line 2" :value="item.add2"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <text-field field-name="add3" label="Address Line 3" :value="item.add3"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <text-field field-name="town" label="Town" :value="item.town"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <text-field field-name="county" label="County" :value="item.county"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <text-field field-name="postcode" label="Post Code" :value="item.postcode"></text-field>
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