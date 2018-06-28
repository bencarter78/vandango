<template>
    <div>
        <a class="is-link" :href="'/usermanager/account/' + data.user.username">{{ data.name }}</a>
        <span v-if="data.user.meta.probation_end_date" class="badge badge-warning spacer-left-1x">
            <small>Probation</small>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['data']
    }
</script>