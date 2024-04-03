<script>

import Layout from "@/Pages/Shared/Layout.vue";
import {Head, Link} from "@inertiajs/vue3";
import Create from "@/Pages/Shared/Create.vue";
import NavBarAuthor from "@/Pages/Shared/NavBarAuthor.vue";

export default {
    components: {NavBarAuthor, Create, Link, Head, Layout},
    data() {
        return {
            Msg: '',
            post: {
                id: this.editPosts.id,
                title: this.editPosts.title_post,
                body: this.editPosts.text_post
            }
        }
    },

    props: {
        editPosts: Object
    },

    methods: {
        editPost() {
            this.$inertia.post(this.route('saveEdit', this.post))
        },
        flashMSG(){
            this.$page.props.flash.message=''
        }
    }
}
</script>


<template>
    <Layout>
        <Head>
            <title>Author Page</title>
        </Head>
        <div class="flex flex-row">
            <NavBarAuthor class="w-1/5 ml-8"></NavBarAuthor>
            <div class="w-4/5 flex flex-row justify-center">

                <div class="w-full">
                    <div class="flex justify-center">
                        <div class="flex w-3/4 flex-col">
                            <div v-if="this.$page.props.flash.message"
                                 class="bg-green-100 flex flex-col items-center border border-green-400 text-green-700 px-4 py-3 rounded relative"
                                 role="alert">
                                <p>{{this.$page.props.flash.message}}</p>
                                <button
                                    v-on:click="flashMSG"
                                    type="submit"
                                >
                                    <p class="border border-green-400 p-1 rounded">OK</p>
                                </button>
                            </div>
                            <div v-else>

                                <br>
                                <p><b>Edit post</b> </p>
                                <br>
                                <div>
                                    <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title
                                        post</label>

                                    <input type="text"
                                           v-model="post.title"
                                           value="{{post.title}}"
                                           id="small-input"
                                           class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    <p v-if="this.$page.props.errors.title" class="text-red-500 font-bold">{{ this.$page.props.errors.title }}</p>
                                </div>
                                <p class="mt-4">Tell what would you like share with us:</p>
                                <form>
                                    <div
                                        class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                        <div class="flex items-center justify-between px-3 py-2 border-b dark:border-gray-600">
                                            <div
                                                class="flex flex-wrap items-center divide-gray-200 sm:divide-x sm:rtl:divide-x-reverse dark:divide-gray-600">
                                                <div class="flex items-center space-x-1 rtl:space-x-reverse sm:pe-4">
                                                    <button data-tooltip-target="tooltip-default" type="button"
                                                            class="tooltip p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                        <svg class="w-4 h-4 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                             fill="currentColor" viewBox="0 0 16 20">
                                                            <path
                                                                d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z"/>
                                                            <path
                                                                d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
                                                        </svg>
                                                        <span class="tooltiptext">Upload image</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800 justify-self-center">
                                            <label for="editor" class="sr-only">Publish post</label>
                                            <textarea id="editor" rows="20"
                                                      v-model="post.body"
                                                      class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                                      placeholder="Write an article..." required></textarea>
                                            <p v-if="this.$page.props.errors.body" class="text-red-500 font-bold">{{ this.$page.props.errors.body }}</p>
                                        </div>
                                    </div>
                                    <p  class="text-red-500 font-bold"></p>

                                    <div class="flex justify-center">
                                        <button
                                            v-on:click.prevent="editPost"
                                            class="flex flex-row justify-self-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                            Edit post
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </Layout>
</template>



<style scoped>
/* Tooltip container */
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;

    /* Position the tooltip text */
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;

    /* Fade in tooltip */
    opacity: 0;
    transition: opacity 0.3s;
}

/* Tooltip arrow */
.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
</style>
