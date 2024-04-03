<script>

import Layout from "@/Pages/Shared/Layout.vue";
import {Head, Link} from "@inertiajs/vue3";
import AddPhoto from "@/Pages/Shared/AddPhoto.vue";

export default {
    components: {AddPhoto, Link, Head, Layout},
    data() {
        return {
            post: {
                title: '',
                body: '',
                tile: ''
            },
            flashMsg: this.$page.props.flash.message,
            photo: '',
            counterChanges: 0,
            namePhotos: [],
            tileOfPost: null
        }
    },
    props: {
        test: Object
    },
    watch: {
        flashMsg() {
            console.log(this.arrayName)
        },
        photo() {
            this.counterChanges++
        },
        tileOfPost(x){
            this.post.tile=x
        }
    },
    computed: {
        counterPhoto() {
            if (!this.photo) {
                console.error("Photo property is undefined.");
                return;
            }

            let x = Object.assign({}, this.photo);

            if (!x.photo) {
                console.error("Photo property inside 'x' object is undefined.");
                return;
            }

            let FileList = x.photo;

            this.namePhotos = []
            for (let i = 0; i < FileList.length; i++) {
                this.namePhotos.push(FileList[i].name)
            }

            // if(FileList[0].name){
            //     this.namePhotos.push(FileList[0].name)
            // }
            //
            // if(FileList[1].name){
            //     this.namePhotos.push(FileList[1].name)
            // }
            //
            // if(FileList[2].name){
            //     this.namePhotos.push(FileList[2].name)
            // }


            console.log(this.namePhotos);

            console.log(FileList.length);

            return FileList.length
        }
    },
    methods: {
        postArticle(x) {
            if (this.photo !== 'more then 3') {
                let test = {
                    user_id: x,
                    title_post: this.post.title,
                    text_post: this.post.body,
                    tile: this.tileOfPost
                }

                const data={
                    post: this.post,
                    tile: this.tileOfPost,
                    photo: this.photo
                }

                this.counterChanges = 0
                this.$inertia.post(this.route('save', this.post), this.photo, test)
            }
        },
        flashMSG() {
            this.post.title = ''
            this.post.body = ''
            this.$page.props.flash.message = ''
        },
        photoChild(object) {
            this.tileOfPost=null
            this.photo = ''
            this.photo = object
        }
    }
}
</script>

<template>
    <div class="w-full">
        <div class="flex justify-center">
            <div class="flex w-3/4 flex-col">
                <div v-if="this.$page.props.flash.message"
                     class="bg-green-100 flex flex-col items-center border border-green-400 text-green-700 px-4 py-3 rounded relative"
                     role="alert">
                    <p>{{ this.$page.props.flash.message }}</p>
                    <button
                        v-on:click="flashMSG"
                        type="submit"
                    >
                        <p class="border border-green-400 p-1 rounded">OK</p>
                    </button>
                </div>
                <div v-else>
                    <br>
                    <p><b>Create post</b></p>
                    <br>
                    <div>
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title
                            post</label>
                        <input type="text"
                               v-model="post.title"
                               id="small-input"
                               class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                        <p v-if="test.title" class="text-red-500 font-bold">{{ test.title }}</p>
                    </div>

                    <div class="w-full flex flex-col justify-start mt-3 mb-3">
                        <p class="mr-5">Add photo</p>
                        <div>
                            <AddPhoto
                                @photo="photoChild"
                            />
                            <p>Name of picture file would be caption under photo in the post. </p>
                            <div v-if="counterPhoto>1" class="bg-orange-500">
                                <p>Choose one photo as tile of post. </p>
                                <p>Counter: {{ counterPhoto }}</p>
                                <div v-for="(name, index) in namePhotos" :key="index" class="flex flex-col">
                                    <div class="flex flex-row items-start">
                                        <label :for="name" class="ml-3">
                                            <input type="radio" :id="name" :value="name" v-model="tileOfPost">
                                            {{ name}}
                                        </label>
                                    </div>
                                </div>
                                <p>select {{tileOfPost}}</p>
                            </div>
                        </div>

                    </div>
                    <div v-show="counterChanges<1">
                        <p v-if="test['photo.0']" class="text-red-500 font-bold">
                            {{ $page.props.errors["photo.0"].replace('photo.0', photo.photo[0].name) }}</p>
                        <p v-if="test['photo.1']" class="text-red-500 font-bold">
                            {{ $page.props.errors["photo.1"].replace('photo.1', photo.photo[1].name) }}</p>
                        <p v-if="test['photo.2']" class="text-red-500 font-bold">
                            {{ $page.props.errors["photo.2"].replace('photo.2', photo.photo[2].name) }}</p>
                    </div>

                    <p class="mt-4">Tell what would you like share with us:</p>
                    <form>
                        <div>
                                <textarea id="editor" rows="20"
                                          v-model="post.body"
                                          class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="Write an article..."></textarea>
                        </div>
                        <p v-if="test.body" class="text-red-500 font-bold">{{ test.body }}</p>
                        <div class="flex justify-center ">
                            <button
                                v-on:click.prevent="postArticle($page.props.auth.user.id)"
                                class="flex flex-row justify-self-center mt-2 px-5 py-2.5 text-sm font-medium text-center text-white  rounded-lg focus:ring-4 "
                                :class="(this.photo==='more then 3')? 'bg-gray-200':'bg-blue-600 hover:bg-blue-800'"
                            >
                                Publish post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

input[type="file"] {

}

.custom-file-upload {
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}

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
