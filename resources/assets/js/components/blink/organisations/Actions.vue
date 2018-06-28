<template>
    <div>
        <div class="dropdown">
            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-primary">
                Actions
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right" aria-labelledby="dLabel">
                <li>
                    <a :href="enquiryEndpoint">Add Enquiry</a>
                </li>
                <li>
                    <span class="is-link" @click="showContact = true">Add Contact</span>
                </li>
                <li>
                    <span class="is-link" @click="showLocation = true">Add Location</span>
                </li>
            </ul>
        </div>

        <div v-if="showContact">
            <blink-contact-add @toggle="showContact = false" :contact-endpoint="contactEndpoint" :organisation-id="organisationId" display="true"></blink-contact-add>
        </div>

        <div v-if="showLocation">
            <address-create @toggle="showLocation = false" :location-endpoint="locationEndpoint" display="true"></address-create>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['contactEndpoint', 'locationEndpoint', 'enquiryEndpoint', 'organisationId'],

        data () {
            return {
                showContact: false,
                showLocation: false
            }
        }
    }
</script>

<style scoped>
    .dropdown-menu > li > span.is-link {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: normal;
        line-height: 1.42857143;
        color: #333333;
        white-space: nowrap;
        cursor: pointer;
    }
</style>