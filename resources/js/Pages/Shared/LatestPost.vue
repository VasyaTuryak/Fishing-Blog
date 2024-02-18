<script>

import Layout from "@/Pages/Shared/Layout.vue";
import {Head, Link} from "@inertiajs/vue3";
// import moment from "moment/moment.js";
import moment from 'moment-timezone';

export default {
    components: {Link, Head, Layout, moment},
    data() {
        return {
            indexInArray: 0,
            perPage: 6,
            currentPage: 1,
            search: 'search route'
        }
    },
    props: {
        posts: Array
    },
    computed: {
        countPageCalc() {
            return Math.ceil(this.posts.length / this.perPage)
        },
        lists() {
            const items = this.posts;
            return items.slice(
                (this.currentPage - 1) * this.perPage,
                this.currentPage * this.perPage
            )
        },

    },
    methods: {
        showNext() {
            if (this.currentPage < this.countPageCalc) {
                this.currentPage += 1
            }
        },
        showPrevios() {
            if (this.currentPage > 1) {
                this.currentPage -= 1
            }
        },
        timeM(test) {
            let year = test.slice(0, 4)
            let month = parseInt(test.slice(6, 7)) - 1
            let date = test.slice(8, 10)
            let hour = parseInt(test.slice(11, 13))+2
            let minute = test.slice(14, 16)
            return moment.tz([year, month, date, hour, minute], "Europe/Kyiv").fromNow();
        },
    }
}
</script>

<template>
    <Layout>
        <Head>
            <title>posts</title>
        </Head>
        <div class="flex justify-center">
            <form class="w-96">
                <label for="search"
                       class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="search"
                           class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Key in what you are interested for" required>
                    <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Search
                    </button>
                </div>
            </form>
        </div>
        <div class="grid justify-items-center">
            <div>
                <p class="mr-auto">Search in title and body text, return where is more matches </p>
            </div>
        </div>
        <div class="flex flex-col items-center">
            <p>LATEST ADDED POST ON SITE:</p>
            <p>correct time zone</p>
            <div class=" flex flex-row justify-center">
                <button v-on:click="showPrevios" v-show="currentPage!==1" class="mr-3"><- Previous page</button>
                <button v-on:click="showNext" v-show="currentPage!==countPageCalc" class="ml-3">Next page -></button>
            </div>
            <div class="grid grid-cols-3  content-center gap-2 w-3/5">
                <div v-for="post in lists" class="border-l-blue-700 text-red-800 m-2 ">
                    <Link
                        :href="`/readpost/${post.id}`" class="link">
                        <p class="text-wrap">Title post: {{ post.title_post }}</p>
                        <img
                            src="data:image/jpeg;base64,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">
                        <p>Name author: {{ post.user.name }}</p>
                        <p>Rating: 1 to 5</p>
                        <p>Created {{ timeM(post.created_at) }}</p>
                    </Link>
                </div>
            </div>
        </div>
    </Layout>
</template>

<style scoped>

</style>
