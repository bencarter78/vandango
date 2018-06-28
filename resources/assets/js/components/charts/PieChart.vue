<script>
    import {Pie} from 'vue-chartjs'

    export default Pie.extend({
        props: ['data'],

        data() {
            return {
                labels: [],
                chartData: [],
                colors: [],
                datasets: [],
                defaultColors: [
                    '#e52d2d', '#47a447', '#1976D2', 'gold', '#ff7200', 'deeppink', 'darkcyan', 'purple', 'indigo', 'brown'
                ]
            }
        },

        mounted() {
            this.data.forEach((d, index) => {
                this.labels.push(d.name)
                this.chartData.push(d.total)
                this.colors.push(this.defaultColors[index])
            })

            this.buildChart()
        },

        methods: {
            buildChart() {
                this.renderChart({
                    labels: this.labels,
                    datasets: [
                        {
                            backgroundColor: this.colors,
                            data: this.chartData
                        }
                    ]
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