<script>
import Layout from "@/Pages/Shared/Layout.vue";
import {Head} from "@inertiajs/vue3";

export default {
    name: "Post",
    components: {Head, Layout},
    data() {
        return {
            textComment: '',
            enlarge: false,
            indexPhotoToEnlarge: null
        }
    },
    props: {
        post: Object,
        comments: Object,
        url: Object,
        tile: String

    },
    computed: {},
    methods: {
        addComment(x, y) {
            let test = {
                userId: x,
                postId: y,
                text: this.textComment
            }
            this.textComment = ''
            this.$inertia.post(this.route('addPost'), test, {
                preserveScroll: true,
            })
        },
        enlargePicture(x) {
            if(this.enlarge!==false){
                this.indexPhotoToEnlarge = x
                this.enlarge = !this.enlarge
            }else{
                this.indexPhotoToEnlarge = null
                this.enlarge = !this.enlarge
            }
        },
        activePhotoOrNot(x) {
            if (this.indexPhotoToEnlarge === x){
                return true
            }
        },
        capitalizeFirstLetter(x) {
            let reg = new RegExp('\\.[^\\/.]+$')
            let test = x.charAt(0).toUpperCase() + x.slice(1)
            return test.replace(reg, '')
        }
    }
}
</script>

<template>
    <Layout>
        <Head>
            <title>Post</title>
        </Head>

        <div class="flex flex-col items-center mb-10">
            <div class="w-2/5">
                <p class="text-2xl mb-3">Title: {{ post.title_post }}</p>
                <p class="mb-3">Click on the photo to enlarge it</p>
                <div v-if="Object.keys(url).length>0">
                    <div v-for="(x, index) in url">
                        <figure>
                            <img :src="x"
                                 v-on:click="enlargePicture(index)"
                                 :class="activePhotoOrNot(index)&& 'zoom'"
                                 alt="PicturesOfPost"/>
                            <figcaption><b>Caption: {{ capitalizeFirstLetter(index) }}</b></figcaption>
                        </figure>
                        <br>
                    </div>
                </div>
                <div v-else-if="url.length=0">
                    <img src="https://goldfishnet.in.ua/static/img/places/resize/51/subitskyi-skelnyi-monastyr.jpg"
                         class="mb-3">
                </div>
                <p>Text: {{ post.text_post }}</p>
            </div>
            <br>
            <div>
                <p>COMENTS:</p>
                <br>
                <div v-for="x in comments">
                    <p>Comment's author: {{ x.user.name }}</p>
                    <p> USER COMMENT: {{ x.content }}</p>
                    <br>
                </div>
            </div>

            <form v-if="$page.props.auth.user" class="w-full flex flex-col items-center">
                <br>
                <div class="px-4 py-2 w-3/5 bg-white rounded-b-lg dark:bg-gray-800 justify-self-center">
                    <br>
                    <p v-if="$page.props.errors.text" class="text-rose-500">{{ $page.props.errors.text }}</p>
                    <br>
                    <textarea id="editor" rows="5"
                              v-model="textComment"
                              class="block w-full px-0 text-sm text-gray-800 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                              placeholder="Write your comment..."
                              required></textarea>
                </div>
                <br>
                <div class="flex justify-center">
                    <button
                        v-on:click.prevent="addComment($page.props.auth.user.id, post.id)"
                        class="flex flex-row justify-self-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        Add comment
                    </button>
                </div>
            </form>
        </div>
    </Layout>
</template>

<style scoped>


.zoom {
    transition: transform 1s ease;
    transform: scale(1.7);
}

img {
    transition: transform 1s ease;
}

</style>
