<template>
    <div class="alert alert-danger" v-if="errors">
        <p class="spacer-bottom-2x"><strong>Whoops!</strong> There were some errors...</p>
        <ul class="list-unstyled">
            <li v-for="e of errors">
                <i class="fa fa-times"></i> {{ e[0] }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['errors']
    }
</script>