<template>
    <div>
        <span @click="toggleModal">
            <i class="fa fa-pencil"></i>
        </span>

        <modals-base v-if="showModal">
            <h3 slot="header">Update Employee Count</h3>

            <div slot="body">
                <form :action="url" method="post">
                    <input type="hidden" name="_token" :value="token">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="updated_by" :value="updatedBy">

                    <div class="form-group spacer-bottom-3x">
                        <text-field :value="count" fieldName="employee_count"></text-field>
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
        props: ['count', 'url', 'updatedBy'],

        data () {
            return {
                showModal: false,
                token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },

        methods: {
            toggleModal () {
                this.showModal = !this.showModal
            }
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