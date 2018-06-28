<template>
    <p v-if="dataSet">
        Showing <strong>{{ dataSet.from }}-{{ dataSet.to }}</strong> of <strong>{{ dataSet.total }}</strong>
        results
    </p>
</template>

<script>
    export default {
        props: ['dataSet']
    }
</script>