<template>
    <div>
        <label for="qualification_plan">Qualification Plan</label>
        <select name="qualification_plan" id="qualification_plan" v-model="plan" class="form-control" @focus="setSector">
            <option value="">Please select...</option>
            <option v-for="plan in filteredPlans" :value="plan.plan">
                {{ plan.plan }}: {{ plan.descrip }}
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        props: ['plan', 'qualPlans'],

        data() {
            return {
                sector: '',
                plans: [],
            }
        },

        computed: {
            filteredPlans() {
                return this.plans.filter(plan => plan.descrip.search(this.sector) !== -1)
            }
        },

        mounted() {
            this.plans = JSON.parse(this.qualPlans)
        },

        methods: {
            setPlans(plans) {
                plans.forEach(plan => this.plans.push(plan))
            },

            setSector: function () {
                this.sector = document.getElementsByName('sector_id')[0].value
            }
        },
    }
</script>
