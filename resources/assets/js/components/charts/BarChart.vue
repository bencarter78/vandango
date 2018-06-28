<script>
    import {Bar} from 'vue-chartjs'

    export default Bar.extend({
        props: ['data'],

        data() {
            return {
                labels: [],
                chartData: [],
                colors: [],
                datasets: []
            }
        },

        mounted() {
            JSON.parse(this.data).forEach(d => {
                this.labels.push(d.name)
                this.datasets.push({
                    label: d.name,
                    backgroundColor: this.dynamicColors(),
                    data: [d.total]
                })
            })

            this.buildChart()
        },

        methods: {
            buildChart() {
                this.renderChart({
                    labels: this.labels,
                    datasets: this.datasets
                })
            },

            dynamicColors() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return `rgb(${r},${g},${b})`;
            }
        }
    })
</script>