<template>
    <div>
        <span @click="toggleModal">
            <i class="fa fa-pencil"></i>
        </span>

        <modals-base v-if="showModal">
            <h3 slot="header">Update Contact</h3>

            <div slot="body">
                <form :action="url" method="post">
                    <input type="hidden" name="_token" :value="token">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="updated_by" :value="updatedBy">

                    <div class="form-group spacer-bottom-3x">
                        <text-field label="Name" fieldName="contact_name" :value="user.name"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <text-field fieldName="contact_tel" label="Telephone" :value="item.tel"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <text-field fieldName="contact_email" label="Email" :value="item.email"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <label>Organisation</label>
                        <blink-organisation-search :organisation="item.organisation"></blink-organisation-search>
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
        props: ['contact', 'url', 'updatedBy'],

        data () {
            return {
                showModal: false,
                item: {},
                token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                endpoint: '/api/v1/blink/contacts'
            }
        },

        mounted () {
            this.item = JSON.parse(this.contact)
        },

        computed: {
            user () {
                this.item.name = this.item.first_name + ' ' + this.item.surname
                return this.item
            }
        },

        methods: {
            toggleModal () {
                this.showModal = !this.showModal
            },

            setContact (contact) {
                this.item = contact
            }
        }
    }
</script>