<template>
    <div class="chart-container">
        <p v-if="presentForPeriods.length > 0 && presentForPeriods[0].data.length === 31">За месяц</p>
        <p v-else-if="presentForPeriods.length > 1 && presentForPeriods[1].data.length === 8">За неделю</p>
        <p v-else>За полгода</p>
        <canvas ref="lineChart"></canvas>
    </div>
</template>

<script>
import { Chart } from 'chart.js/auto';

export default {
    props: {
        presentForPeriods: {
            type: Array,
            required: true
        }
    },
    mounted() {
        this.renderChart();
    },
    methods: {
        renderChart() {
            // Проверяем, что данные доступны и корректны
            if (!this.presentForPeriods || this.presentForPeriods.length === 0) {
                console.error('Данные для построения графика отсутствуют.');
                return;
            }

            const labels = [];
            const datasets = [];

            // Проверяем, что данные первого элемента доступны
            const firstSubjectData = this.presentForPeriods[0].data;
            if (firstSubjectData && firstSubjectData.length > 0) {
                firstSubjectData.forEach(dayData => {
                    labels.push(dayData.startDate.toLocaleDateString());
                });

                // Создаем наборы данных для каждого предмета
                this.presentForPeriods.forEach((period, index) => {
                    if (period.data) {
                        const percentages = period.data.map(day => day.percentage);
                        datasets.push({
                            label: period.subject,
                            data: percentages,
                            backgroundColor: this.getFixedColor(index), // Получаем фиксированный цвет по индексу
                            borderColor: this.getFixedColor(index),
                            fill: false,
                            tension: 0.5
                        });
                    } else {
                        console.error(`Нет данных для предмета с индексом ${index}.`);
                    }
                });
            } else {
                console.error('Нет данных для первого предмета.');
                return;
            }

            const chartData = {
                labels: labels,
                datasets: datasets
            };

            const chartOptions = {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 100
                    }
                }
            };

            // Получаем контекст canvas
            const ctx = this.$refs.lineChart.getContext('2d');

            // Создаем и отображаем график
            new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: chartOptions
            });
        },
        getFixedColor(index) {
            // Фиксированные цвета
            const colors = [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)'
            ];
            // Если индекс больше количества цветов, возвращаем случайный цвет
            if (index >= colors.length) {
                return `rgb(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})`;
            }
            // Иначе возвращаем фиксированный цвет по индексу
            return colors[index];
        }
    }
}
</script>

<style scoped>
.chart-container {
    width: 100%;
    width: 550px;
    /* Установите максимальную ширину графика */
    height: 300px;
    margin: 40px 10px;
    /* Установите высоту графика */
}

canvas {
    width: 100% !important;
    /* Установите ширину canvas в 100% от контейнера */
    height: 100% !important;
    /* Установите высоту canvas в 100% от контейнера */
}
</style>
