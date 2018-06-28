<template>
    <div>
        <ul class="actions list-inline">
            <li v-if="data.editUri">
                <a class="btn btn-primary btn-circle" name="edit" :href="data.editUri">
                    <i class="fa fa-pencil"></i>
                </a>
            </li>

            <li v-if="data.showUri">
                <a class="btn btn-circle btn-warning btn-xs" name="" :href="data.showUri">
                    <i class="fa fa-search"></i>
                </a>
            </li>

            <li v-if="data.deleteUri">
                <a class="btn btn-circle btn-danger btn-xs" name="delete" @click="showModal = true">
                    <i class="fa fa-trash"></i>
                </a>
            </li>
        </ul>

        <modals-base v-if="showModal">
            <h3 slot="header">Delete</h3>
            <div slot="body">
                Are you sure you want to delete this? Please confirm by clicking the button below.
            </div>
            <div slot="footer">
                <form method="POST" v-bind:action="data.deleteUri" accept-charset="UTF-8">
                    <input name="_method" type="hidden" value="DELETE">
                    <input name="_token" type="hidden" v-bind:value="csrfToken">
                    <input name="submit" class="spacing-top btn btn-lg btn-danger" type="submit" value="Delete">
                </form>
            </div>
        </modals-base>
    </div>
</template>

<script>
    export default {
        props: ['data'],

        data () {
            return {
                showModal: false,
            }
        },

        computed: {
            csrfToken: function () {
                return document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    }
</script>