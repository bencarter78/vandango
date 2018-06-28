<template>
    <form @submit.prevent.default="$emit('search', query)">
        <div class="input-group spacer-bottom-2x">
            <input type="text" class="form-control" v-model="query" placeholder="Search..." autofocus>
            <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-search"></i> Search
                    </button>
                </span>
        </div>
    </form>
</template>

<script>
    export default {
        props: {
            value: ''
        },

        data() {
            return {
                query: this.value
            }
        }
    }
</script>