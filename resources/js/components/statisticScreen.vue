<template>
    <div>
        <!-- Табы -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="chartOne-tab" data-bs-toggle="tab" data-bs-target="#chartOne"
                    type="button" role="tab" aria-controls="chartOne" aria-selected="true">Общие диаграммы
                    ошибок</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="chartTwo-tab" data-bs-toggle="tab" data-bs-target="#chartTwo" type="button"
                    role="tab" aria-controls="chartTwo" aria-selected="false">Диаграммы решенных вариантов</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="chartThree-tab" data-bs-toggle="tab" data-bs-target="#chartThree"
                    type="button" role="tab" aria-controls="chartThree" aria-selected="false">Статистика по
                    школам</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="chartOne" role="tabpanel" aria-labelledby="chartOne-tab">
                <!-- chartOne компонент -->
                <div class="chartsBlockOne">
                    <chartOne v-for="(el, key) in countAnswers" :key="key" :countSolvedVariants="maxCounts[key]"
                        :subject="key" :falseAnswerCounts="el" />
                </div>
            </div>
            <div class="tab-pane fade" id="chartTwo" role="tabpanel" aria-labelledby="chartTwo-tab">
                <!-- chartTwo компонент -->
                <div v-if="Object.keys(presentForPeriods).length" class="chartsBlockTwo">
                    <chartTwo v-for="(el, index) in presentForPeriods" :key="index" :presentForPeriods="el" />
                </div>
                <div v-else>
                    Loading data for Chart Two...
                </div>
            </div>
            <div class="tab-pane fade" id="chartThree" role="tabpanel" aria-labelledby="chartThree-tab">
                <!-- chartTwo компонент -->
                <div class="chartsBlockThree">
                    <div class="chartBlockThree" v-for="(el, key) in errorCountsForSchools">
                        <span>Школа {{ key }}</span>
                        <chartOne v-for="(el2, key2) in el" :key="key2" :countSolvedVariants="maxCounts[key2]"
                            :subject="key2" :falseAnswerCounts="el2" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useMainStore } from "../stores/main";
import chartOne from './charts/chartOne.vue';
import chartTwo from './charts/chartTwo.vue';
import chartThree from './charts/chartThree.vue';

export default {
    components: {
        chartOne, chartTwo, chartThree
    },
    setup() {
        const mainStore = useMainStore();
        return {
            mainStore,
        };
    },
    async mounted() {
        await this.fetchData();
        this.countFalseAnswersForAllVariants();
        this.calculatePercentage();
        this.countVariantsByType();
        this.countsMax();
        this.fetchErrorCountsForSchool();
    },

    data() {
        return {
            responseData: [],
            countAnswers: [],
            presentForPeriods: [],
            countsByType: [],
            maxCounts: [],
            errorCountsForSchools: []
        }
    },
    methods: {
        async fetchData() {
            try {
                const url = "api/solveds";
                const response = await fetch(url);
                const data = await response.json();
                this.responseData = data.data
            } catch (error) {
                console.error("Ошибка при загрузке данных:", error);
            }
        },
        async fetchErrorCountsForSchool() {
            try {
                const response = await fetch('api/solvedsSchool', {
                    method: "GET",
                    headers: {
                        Accept: "application/json"
                    }
                });
                const data = await response.json();
                const errorCounts = {};

                // Проверяем, является ли data массивом
                if (!Array.isArray(data.data)) {
                    console.error('Data не является массивом:', data);
                    return null;
                }

                data.data.forEach(entry => {
                    const schoolName = entry.name;
                    const subject = entry.subject;
                    const result = JSON.parse(entry.result);

                    if (!errorCounts[schoolName]) {
                        errorCounts[schoolName] = {};
                    }
                    if (!errorCounts[schoolName][subject]) {
                        errorCounts[schoolName][subject] = Array(result.length).fill(0);
                    }

                    result.forEach((score, index) => {
                        if (score === 0) {
                            errorCounts[schoolName][subject][index]++;
                        }
                    });
                });

                this.errorCountsForSchools = errorCounts;
                console.log(this.errorCountsForSchools);
            } catch (error) {
                console.error('Ошибка при получении данных:', error);
                return null;
            }
        },

        countFalseAnswersForAllVariants() {
            // Создаем объект для хранения результатов по каждому предмету
            const resultsBySubject = {};

            // Перебираем каждый элемент данных
            this.responseData.forEach(item => {
                const subject = item.variant.subject;
                const results = JSON.parse(item.result); // Преобразуем строку результатов в массив

                // Инициализируем массив для хранения подсчетов, если его еще нет
                if (!resultsBySubject[subject]) {
                    resultsBySubject[subject] = new Array(results.length).fill(0);
                }

                // Перебираем результаты и считаем количество нулей
                results.forEach((result, index) => {
                    if (result === 0) {
                        resultsBySubject[subject][index]++;
                    }
                });
            });

            this.countAnswers = resultsBySubject;
        },
        countsMax() {
            const groupedData = {};
            this.responseData.forEach(item => {
                const subject = item.variant.subject;
                if (!groupedData[subject]) {
                    groupedData[subject] = [];
                }
                groupedData[subject].push(item);
            });

            const maxCounts = {};
            Object.keys(groupedData).forEach(subject => {
                maxCounts[subject] = groupedData[subject].length;
            });

            this.maxCounts = maxCounts;
            console.log(this.maxCounts);
        },
        async calculatePercentage() {
            const now = new Date();
            const monthAgo = new Date(now.getFullYear(), now.getMonth() - 1, now.getDate());
            const weekAgo = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 7);
            const sixMonthsAgo = new Date(now.getFullYear(), now.getMonth() - 6, now.getDate());

            const groupedData = {};
            this.responseData.forEach(item => {
                const subject = item.variant.subject;
                if (!groupedData[subject]) {
                    groupedData[subject] = [];
                }
                groupedData[subject].push(item);
            });

            const monthData = this.calculateDataForPeriods(groupedData, monthAgo, now);
            const weekData = this.calculateDataForPeriods(groupedData, weekAgo, now);
            const sixMonthsData = this.calculateDataForPeriods(groupedData, sixMonthsAgo, now);

            this.presentForPeriods = [monthData, weekData, sixMonthsData];
            console.log(this.presentForPeriods);
        },
        calculateDataForPeriods(groupedData, startDate, endDate) {
            const periodData = [];
            Object.keys(groupedData).forEach(subject => {
                const dailyData = [];
                let currentDate = new Date(endDate);

                while (currentDate >= startDate) {
                    const dayStartDate = new Date(currentDate);
                    dayStartDate.setHours(0, 0, 0, 0);
                    const dayEndDate = new Date(currentDate);
                    dayEndDate.setHours(23, 59, 59, 999);

                    const filteredData = groupedData[subject].filter(item => {
                        const completionDate = new Date(item.created_at);
                        return completionDate >= dayStartDate && completionDate <= dayEndDate;
                    });

                    let totalQuestions = 0;
                    let totalCorrectAnswers = 0;

                    filteredData.forEach(item => {
                        const results = JSON.parse(item.result);
                        totalQuestions += results.length;
                        totalCorrectAnswers += results.filter(result => result === 1).length;
                    });

                    const percentage = totalQuestions > 0 ? ((totalCorrectAnswers / totalQuestions) * 100).toFixed(2) : 0;

                    dailyData.unshift({
                        startDate: dayStartDate,
                        endDate: dayEndDate,
                        totalQuestions,
                        totalCorrectAnswers,
                        percentage
                    });

                    currentDate.setDate(currentDate.getDate() - 1);
                }

                periodData.push({ subject, data: dailyData });
            });

            return periodData;
        },

        async countVariantsByType() {
            // Проверяем, что данные доступны
            if (!this.responseData || this.responseData.length === 0) {
                console.error('Данные для подсчета вариантов отсутствуют.');
                return;
            }

            // Создаем объект для хранения количества решенных вариантов по каждому типу
            const countsByType = {};

            // Считаем количество решенных вариантов по каждому типу
            this.responseData.forEach(item => {
                const subject = item.variant.subject;
                countsByType[subject] = (countsByType[subject] || 0) + 1;
            });
            this.countsByType = countsByType
            console.log('Количество решенных вариантов по каждому типу:', this.countsByType);
        }
    }
}
</script>

<style scoped>
.chartsBlockOne {
    justify-content: center;
    display: flex;
    flex-wrap: wrap;
}

.chartsBlockTwo {
    justify-content: center;
    display: flex;
    flex-wrap: wrap;
}

.chartsBlockThree {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.chartBlockThree {
    margin: 10px;
    text-align: center;
    background-color: #F3F6E6;
    border-radius: 10px;
}

.chartBlockThree span {
    color: #C76991;
}
</style>
