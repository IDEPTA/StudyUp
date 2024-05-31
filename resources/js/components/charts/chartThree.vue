<template>
    <div class="chart-container">
        <canvas ref="pieChart"></canvas>
    </div>
</template>

<script>
import { Chart } from 'chart.js/auto';

export default {
    props: {
        countsByType: {
            type: Object,
            required: true
        }
    },
    mounted() {
        this.renderPieChart();
    },
    methods: {
        renderPieChart() {
            const labels = Object.keys(this.countsByType);
            const data = Object.values(this.countsByType);

            const ctx = this.$refs.pieChart.getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(153, 102, 255)',
                            'rgb(255, 159, 64)'
                        ]
                    }]
                },
                options: {
                    responsive: true
                }
            });
        }
    }
}
</script>
<style scoped>
.chart-container {
    width: 500px;
    height: auto;
}
</style>
