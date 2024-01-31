<script>
import axios from "axios";
import Layout from "@/Pages/Shared/Layout.vue";
import {Head} from "@inertiajs/vue3";

export default {
    components: {Head, Layout},
    data() {
        return {
            url: '',
            date: '',
            exp: null,
            status: null,
            formDate: '',
            er: ''
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
                    this.url = response.data.hdurl,
                        this.date = response.data.date,
                        this.exp = response.data.explanation,
                        this.status = response.status
                })
                .catch((error => {
                        this.status = error.response.data.code
                        this.er = error.response.data.msg
                        this.url = ''
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
                        <div class="w-3/5 ">
                            <p v-show="status!==null"><b>HTTP response: </b>{{ status }}</p>
                            <p v-show="status!==null &&status!==400"><b>Date: </b> {{ date }}</p>
                            <p class="alert alert-danger" role="alert" v-show="status===400">ERROR message from NASA
                                server: {{ er }}</p>
                            <p class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400 mb-6"
                               v-show="status!==null &&status!==400"><b><u>Picture explanation:</u></b>  {{ exp }}
                            </p>
                        </div>
                        <div class="flex justify-center mb-6 w-1/5">
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
                        <img class="h-auto mx-auto rounded-lg" :src="url" v-show="status!==null &&status!==400"
                             alt="image description">
                    </figure>


                </div>

            </div>
        </Layout>
    </div>

</template>

<style scoped>

</style>
