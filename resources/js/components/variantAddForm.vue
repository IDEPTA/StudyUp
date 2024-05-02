<template>
    <div>
        <form
            enctype="multipart/form-data"
            @submit.prevent="addVariant"
            method="post"
        >
            <select name="subject" v-model="selectedSubject" required>
                <option value="Русский язык">Русский язык</option>
                <option value="Математика профиль">Математика профиль</option>
                <option value="Математика база">Математика база</option>
            </select>
            <div v-if="selectedSubject === 'Русский язык'">
                <input
                    type="text"
                    v-for="n in 26"
                    v-model="answersData[n - 1]"
                    required
                    :key="n"
                    :placeholder="n"
                />
            </div>
            <div v-if="selectedSubject === 'Математика профиль'">
                <input
                    type="text"
                    v-for="n in 12"
                    v-model="answersData[n - 1]"
                    required
                    :key="n"
                    :placeholder="n"
                   
                />
            </div>
            <div v-if="selectedSubject === 'Математика база'">
                <input
                    type="text"
                    v-for="n in 21"
                    v-model="answersData[n - 1]"
                    required
                    :key="n"
                    :placeholder="n"
                />
            </div>
            <input
                type="file"
                name="file"
                id="file"
                accept=".pdf"
                required
                @change="addFile"
            />
            <p >{{ message }}</p>
            <p v-if="errors.file">{{ errors.file[0] }}</p>
            <input type="submit" value="Добавить" />
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            selectedSubject: "",
            file: "",
            answersData: [],
            errors: [],
            message: "",
        };
    },
    methods: {
        addFile(event) {
            this.file = event.target.files[0];
        },
        async addVariant() {
            let formData = new FormData();
            formData.append("file", this.file);
            formData.append("selectedSubject", this.selectedSubject);
            formData.append("answersData", JSON.stringify(this.answersData));
            await fetch("/api/variants", {
                method: "POST",
                headers: {
                    Accept: "application/json",
                },
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.errors) {
                        this.errors = data.errors;
                    }else {
                        this.message = data.message;
                    }
                });
        },
    },
};
</script>
<style scoped>
form {
    background-color: cadetblue;
    margin: 40px auto;
    width: 60%;
    display: flex;
    flex-direction: column;
}
form div {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin: 10px 0px;
}
</style>
