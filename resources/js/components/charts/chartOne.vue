<template>
    <div class="chart-container">
        <canvas ref="chartCanvas"></canvas>
    </div>
</template>

<script>
import { Chart } from 'chart.js/auto';

export default {
    props: {
        subject: {
            type: String,
            required: true
        },
        falseAnswerCounts: {
            type: Array,
            required: true
        },
        countSolvedVariants: {
            type: Number,
            required: true
        }
    },
    mounted() {
        this.renderChart();
    },
    methods: {
        renderChart() {
            const ctx = this.$refs.chartCanvas.getContext('2d');
            const data = this.falseAnswerCounts.map((count, index) => ({
                x: `Задание № ${index + 1}`,
                y: count,
            }));
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.falseAnswerCounts.map((count, index) =>
                        `Задание № ${index + 1}`
                    ),
                    datasets: [
                        {
                            label: `${this.subject} - Неверные ответы`,
                            data: data,
                            backgroundColor: 'rgba(168, 50, 50)',
                            borderColor: 'rgba(168, 50, 50)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: this.countSolvedVariants
                        }
                    }
                }
            });
        }
    }
};
</script>

<style scoped>
.chart-container {
    width: 100%;
    width: 550px;
    /* Установите максимальную ширину графика */
    height: 300px;
    padding: 10px;
    /* Установите высоту графика */
}

canvas {
    width: 100% !important;
    /* Установите ширину canvas в 100% от контейнера */
    height: 100% !important;
    /* Установите высоту canvas в 100% от контейнера */
}
</style>
