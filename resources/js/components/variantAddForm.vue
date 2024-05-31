<template>
    <div>
        <form
            enctype="multipart/form-data"
            @submit.prevent="addVariant"
            method="post"
        >
            <select
                class="form-select form-select-lg mb-3"
                aria-label="Large select example"
                name="subject"
                v-model="selectedSubject"
                required
            >
                <option value="Русский язык" selected>Русский язык</option>
                <option value="Математика профиль">Математика профиль</option>
                <option value="Математика база">Математика база</option>
            </select>
            <div v-if="selectedSubject === 'Русский язык'">
                <input
                    class="formInput"
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
                    class="formInput"
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
                    class="formInput"
                    type="text"
                    v-for="n in 21"
                    v-model="answersData[n - 1]"
                    required
                    :key="n"
                    :placeholder="n"
                />
            </div>

            <input
                class="form-control"
                type="file"
                name="file"
                id="file"
                accept=".pdf"
                required
                @change="addFile"
            />

            <p v-if="message != ''">{{ message }}</p>
            <p v-if="errors.file">{{ errors.file[0] }}</p>
            <input
                type="submit"
                value="Добавить"
                class="btn mt-3 btn-success"
            />
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
                    } else {
                        this.message = data.message;
                    }
                });
            this.answersData = "";
            this.file = "";
            this.message = "Вариант добавлен";
        },
    },
};
</script>
<style scoped>
form {
    background-color: white;
    border: 2px solid #aac6fc;
    border-radius: 5px;
    margin: 40px auto;
    width: 45%;
    display: flex;
    padding: 5px;
    flex-direction: column;
}
form div {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin: 10px 0px;
}
.submit {
    margin: 10px;
    text-decoration: none;
    background-color: #aac6fc;
    padding: 5px;
    border: none;
    border-radius: 5px;
    color: white;
}
.formInput {
    border: none;
    border-bottom: 2px solid #aac6fc;
    padding: 10px;
    margin: 10px;
    outline: none;
}
</style>
