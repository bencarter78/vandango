<template>
    <modals-base v-if="showModal">
        <h3 slot="header" class="modal-title">Add Opportunity</h3>

        <div slot="body">
            <form @submit.prevent="submit">
                <input type="hidden" name="_token" :value="token">
                <input type="hidden" name="user_id" :value="updatedBy">

                <div class="form-group spacer-bottom-3x">
                    <dropdown field-name="sector_id" label="Sector" :options="options"></dropdown>
                </div>

                <div class="form-group spacer-bottom-3x">
                    <dropdown field-name="programme_type" label="Programme Type" :options="progTypes"></dropdown>
                </div>

                <div class="form-group spacer-bottom-3x">
                    <text-field label="Number of Starts" field-name="quantity"></text-field>
                </div>

                <div class="form-group spacer-bottom-3x">
                    <label for="value">Total Potential Value</label>
                    <small>(Whole pounds only)</small>
                    <text-field-addon-left icon="fa-gbp" field-name="value"></text-field-addon-left>
                </div>

                <div class="form-group spacer-bottom-3x">
                    <label>Expected By</label>
                    <datepicker field-name="expected_on" :minDate="moment().toDate()"></datepicker>
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
            require('../../../mixins/Apply.vue'),
            require('../../../mixins/Date.vue'),
            require('../../../mixins/Form.vue'),
            require('../../../mixins/Modal.vue'),
            require('../../../mixins/usermanager/Sector.vue'),
        ],

        props: ['url', 'updatedBy', 'userId'],

        data() {
            return {
                items: {},
                endpoint: '/api/v1/blink/contacts',
                isClosing: false
            }
        },

        mounted() {
            this.fetchSectors('code')
        },

        computed: {
            options() {
                this.sortSectors('code')
                return this.buildOptions(this.sectors, 'id', 'title')
            }
        },

        methods: {
            submit() {
                this.errors = null

                this.setFormData()

                this.$http
                    .post(this.url, this.formData)
                    .then(() => window.location.reload())
                    .catch(err => {
                        console.dir(err)
                        this.errors = err.response.data
                    })
            },

            setFormData() {
                this.formData.append('user_id', this.userId)
                this.formData.append('sector_id', document.getElementById('sector_id').value)
                this.formData.append('quantity', document.getElementById('quantity').value)
                this.formData.append('value', document.getElementById('value').value)
                this.formData.append('expected_on', document.getElementById('expected_on').value)
                this.formData.append('programme_type', document.getElementById('programme_type').value)
            },
        }
    }
</script>