<template>
    <ul class="list-unstyled">
        <li v-if="data.user.meta.mobile">
            <i class="fa fa-fw fa-mobile"></i>{{ data.user.meta.mobile }}
        </li>

        <li v-if="data.user.meta.tel">
            <i class="fa fa-fw fa-phone"></i>{{ data.user.meta.tel }}
        </li>

        <li v-if="data.user.meta.ext">
            <i class="fa fa-fw fa-plus"></i>{{ data.user.meta.ext }}
        </li>

        <li v-if="data.user.email">
            <i class="fa fa-fw fa-envelope"></i>{{ data.user.email }}
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['data']
    }
</script>