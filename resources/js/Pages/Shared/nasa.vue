<script>
import axios from "axios";
import Layout from "@/Pages/Shared/Layout.vue";

export default {
    components: {Layout},
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
    methods: {
        testNasa() {
            axios
                .get('https://api.nasa.gov/planetary/apod?api_key=nRXkolldP7D23RnJnWiLRrpOIqd9bJ50hp2liUFy&date=' + this.formDate)
                .then(response => {
                    this.url = response.data.hdurl,
                        this.date = response.data.date,
                        this.exp = response.data.explanation,
                        this.status = response.status,
                        console.log(response)
                })
                .catch((error => {
                        this.status = error.response.data.code
                        this.er = error.response.data.msg
                        this.url = ''
                    }
                ))
        }
    }
}

</script>

<template>
    <div>
        <Layout></Layout>
        <div class="flex flex-row justify-center m-5 ">
            <div>
                <h2>GET SKY PICTURE of NASA</h2>
                <form class="flex flex-col ">
                    <p>Enter your date</p>
                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" required v-model="formDate" class="w-40">
                    <button type="submit" @click.prevent="testNasa" class="border-2  bg-orange-500 w-20 mt-2">Submit</button>
                </form>
                <p v-show="status!==null"><b>Server status:</b>{{ status }}</p>
                <p v-show="status!==null &&status!==400"><b>Date of HTTP response:</b> {{ date }}</p>
                <p class="alert alert-danger" role="alert" v-show="status===400">ERROR MSG from SERVER NASA: {{ er }}</p>

                <figure>
                    <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400"
                                v-show="status!==null &&status!==400">Picture explanation: {{ exp }}
                    </figcaption>
                    <img class="h-auto mx-auto rounded-lg" :src="url" v-show="status!==null &&status!==400"
                         alt="image description">
                </figure>
            </div>

        </div>
    </div>


</template>

<style scoped>

</style>
