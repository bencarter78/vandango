<template>
    <div>
        <span @click="toggleModal">
            <i class="fa fa-pencil"></i>
        </span>

        <modals-base v-if="showModal">
            <h3 slot="header">Update Organisation</h3>

            <div slot="body">
                <form :action="url" method="post">
                    <input type="hidden" name="_token" :value="token">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="updated_by" :value="updatedBy">

                    <div class="form-group spacer-bottom-3x">
                        <text-field label="Organisation Name" fieldName="name" :value="item.name"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <text-field label="Organisation Alias" fieldName="alias" :value="item.alias"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <dropdown label="Head Office" fieldName="hq_id" :value="item.hq_id" :options="locations()"></dropdown>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <text-field label="Main Number" fieldName="tel" :value="item.tel"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <text-field label="Main Email" fieldName="email" :value="item.email"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <text-field label="Website" fieldName="website" :value="item.website"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <text-field label="Levy Pot" fieldName="levy_pot" :value="item.levy_pot"></text-field>
                    </div>

                    <div class="form-group spacer-bottom-3x">
                        <text-field label="PICS Ref" fieldName="datastore_ref" :value="item.datastore_ref"></text-field>
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
        props: ['organisation', 'url', 'updatedBy'],

        data() {
            return {
                showModal: false,
                item: {},
                token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                endpoint: '/api/v1/blink/organisations'
            }
        },

        mounted() {
            this.item = JSON.parse(this.organisation)
        },

        methods: {
            toggleModal() {
                this.showModal = !this.showModal
            },

            locations() {
                if (this.item.locations) {
                    let data = []
                    this.item.locations.forEach(l => {
                        let address = [l.add1, l.town, l.postcode]
                        data.push({
                            label: address.join(', '),
                            value: l.id
                        })
                    })
                    return data
                }
            }
        }
    }
</script>