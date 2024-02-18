<script>
import Layout from "@/Pages/Shared/Layout.vue";
import {Head} from "@inertiajs/vue3";

export default {
    name: "Post",
    components: {Head, Layout},
    props: {
        post: Object
    }
}
</script>

<template>
    <Layout>
        <Head>
            <title>Post</title>
        </Head>
        <div class="flex flex-col items-center mb-10">
            <div class="w-3/5">
                <p>Title: {{ post.title_post }}</p>
                <img src="https://goldfishnet.in.ua/static/img/places/resize/51/subitskyi-skelnyi-monastyr.jpg">
                <br>
                <p>Text: {{ post.text_post }}</p>
            </div>
            <div>
                <p>COMENTS</p>
                <p>COMENTS</p>
                <p>COMENTS</p>
                <p>COMENTS</p>
                <p>COMENTS</p>
                <p>COMENTS</p>
            </div>
        </div>
    </Layout>
</template>

<style scoped>

</style>
