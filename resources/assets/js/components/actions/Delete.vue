<template>
    <div>
        <a class="is-link text-upper" name="delete" @click="showModal = true">
            <small>Delete</small>
        </a>

        <modals-base v-if="showModal">
            <h3 slot="header">
                <span v-if="isReloading" class="text-success">
                    Successfully Deleted
                    <i class="fa fa-check-square-o"></i>
                </span>
                <span v-else>Delete</span>
            </h3>

            <div slot="body">
                <loaders-clip v-if="isReloading" size="30px"></loaders-clip>

                <p v-else class="text-left">
                    Are you sure you want to delete this? Please confirm by clicking the button below.
                </p>
            </div>
            <div slot="footer">
                <button @click="submit" class="btn btn-danger" v-if="!isReloading">
                    <span v-if="!isRequesting">DELETE</span>
                    <loaders-clip v-else color="#ffffff" size="15px"></loaders-clip>
                </button>
                <span v-else class="btn btn-success">
                    <span class="text-upper">Deleted</span>
                </span>
            </div>
        </modals-base>
    </div>
</template>

<script>
    export default {
        props: ['uri', 'userId'],

        data() {
            return {
                showModal: false,
                isRequesting: false,
                isReloading: false
            }
        },

        methods: {
            submit() {
                this.isRequesting = true
                this.$http
                    .delete(this.uri, {data: {user_id: this.userId}})
                    .then(() => {
                        setTimeout(() => {
                            this.isReloading = true
                            window.location.reload()
                        }, 1000)
                    })
                    .catch(err => {
                        console.log(err)
                        this.isRequesting = false
                    })
            }
        }
    }
</script>