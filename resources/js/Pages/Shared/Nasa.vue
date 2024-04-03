<script>
import axios from "axios";
import Layout from "@/Pages/Shared/Layout.vue";
import {Head} from "@inertiajs/vue3";

export default {
    components: {Head, Layout},
    data() {
        return {
            urlImage: '',
            dateIMG: '',
            IMGdescription: null,
            HTTPstatus: null,
            formDate: '',
            errorMessage: '',
            errorStatus: false,
        }
    },
    beforeMount() {
        this.GetData(this.nowGhatGPT())
    },
    methods: {
        nowGhatGPT() {
            const currentDate = new Date();
            // Extract year, month, and day components
            const year = currentDate.getFullYear();
            const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Month is zero-indexed
            const day = String(currentDate.getDate()).padStart(2, '0');
            // Format the date as "yyyy-mm-dd"
            const formattedDate = `${year}-${month}-${day}`;
            return formattedDate;
        },
        GetData(time) {
            axios
                .get('https://api.nasa.gov/planetary/apod?api_key=nRXkolldP7D23RnJnWiLRrpOIqd9bJ50hp2liUFy&date=' + time)
                .then(response => {
                    this.urlImage = response.data.hdurl,
                        this.dateIMG = response.data.date,
                        this.IMGdescription = response.data.explanation,
                        this.HTTPstatus = response.status
                        this.errorStatus = false
                })
                .catch((error => {
                        this.HTTPstatus = error.response.data.code
                        this.errorMessage = error.response.data.msg
                        this.urlImage = ''
                        this.errorStatus = true
                    }
                ))
        },
        testNasa() {
            this.GetData(this.formDate)
        }
    }
}
</script>

<template>
    <div>
        <Layout>
            <Head>
                <title>NASA</title>
            </Head>
            <div class="flex flex-row justify-center m-5 ">
                <div>
                    <div class="flex flex-row justify-center">
                        <div class="w-3/5 text-pretty">
                            <p><b>HTTP response: </b>{{ HTTPstatus }}</p>
                            <p v-show="!errorStatus"><b>Date: </b> {{ dateIMG }}</p>
                            <div v-show="errorStatus" class="alert alert-danger mr-8 w-full" role="alert"
                                 :class="[errorStatus&&'error']">
                                <p>ERROR message from NASA server: </p>
                                <p class="text-wrap">{{ errorMessage }}</p>
                            </div>
                            <p class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400 mb-6 indent-6 text-justify"
                               v-show="!errorStatus"><b><u>Picture explanation:</u></b>
                                {{ IMGdescription }}
                            </p>
                        </div>
                        <div class="flex justify-center ml-8 mb-6 w-1/5">
                            <form class="flex flex-col justify-center">
                                <div class="grid justify-items-stretch">
                                    <p class="justify-self-center">Get another date</p>
                                    <p class="justify-self-center">Enter your date:</p>
                                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" required v-model="formDate"
                                           class="w-40  mt-2 mb-2 justify-self-center">
                                    <button type="submit" @click.prevent="testNasa"
                                            class="border-2 justify-self-center bg-orange-500 w-20 mt-2">Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <figure>
                        <img class="h-1/3 mx-auto rounded-lg" :src="urlImage"
                             v-show="!errorStatus"
                             alt="image description">
                    </figure>
                </div>
            </div>
        </Layout>
    </div>
</template>

<style scoped>
.error {
    background-color: red;
    color: white;
}
</style>
