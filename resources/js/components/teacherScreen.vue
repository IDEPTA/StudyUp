<template>
    <div class="charts">
        <p>{{ schoolName }}</p>
        <div class="chartBlockThree" v-for="(el, key) in errorCountsForSchools">
            <chartOne class="chart" v-for="(el2, key2) in el" :key="key2" :countSolvedVariants="maxCounts[key2]"
                :subject="key2" :falseAnswerCounts="el2" />
        </div>
    </div>
</template>
<script>
import chartOne from './charts/chartOne.vue';

export default {
    async mounted() {
        await this.fetchData();
        this.getUserID();
        this.getSchoolsInfo();
        this.countsMax();
        await this.fetchErrorCountsForSchool();
    },
    components: {
        chartOne
    },
    data() {
        return {
            userId: "",
            schoolId: "",
            schoolName: "",
            maxCounts: [],
            responseData: [],
            errorCountsForSchools: []
        }
    },
    methods: {
        getUserID() {
            let userData =
                localStorage.length > 0
                    ? JSON.parse(localStorage.getItem("userData"))
                    : JSON.parse(sessionStorage.getItem("userData"));
            this.userId = userData.id;
        },
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
        },

        async getSchoolsInfo() {
            const url = "api/solvedsSchool/" + this.userId
            await fetch(url, {
                method: "GET",
                headers: {
                    Accept: "application/json"
                }
            })
                .then(response => response.json())
                .then(data => {
                    this.schoolId = data.data[0].school.id;
                    this.schoolName = data.data[0].school.name;
                });
            console.log(this.schoolId);
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
                    if (entry.schoolId == this.schoolId) {
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
                    }
                });

                this.errorCountsForSchools = errorCounts;
                console.log(this.errorCountsForSchools);
            } catch (error) {
                return null;
            }
        },
    }
}
</script>
<style scoped>
.charts {
    text-align: center;
}

.chartBlockThree {
    margin: 10px;
    display: flex;
    flex-wrap: wrap;
    text-align: center;
    justify-content: center;
}

.chart {
    background-color: #F3F6E6;
    margin: 10px;
}
</style>
