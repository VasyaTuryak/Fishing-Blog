<script>
import Layout from "@/Pages/Shared/Layout.vue";
import {Head, Link} from "@inertiajs/vue3";
import Create from "@/Pages/Shared/Create.vue";
import NavBarAuthor from "@/Pages/Shared/NavBarAuthor.vue";
import Posts from "@/Pages/Shared/Posts.vue";

export default {
    components: {Link, Head,NavBarAuthor,Create, Layout,Posts},
    data() {
        return {

        }
    },
    props: {
        userPosts: Array,
    }
}
</script>

<template>
    <Layout>
        <Head>
            <title>Author Page</title>
        </Head>
        <div class="flex flex-row">
            <NavBarAuthor class="w-1/5"></NavBarAuthor>
            <div class="w-4/5 flex flex-row justify-center">
                <Posts :test="userPosts"></Posts>
            </div>
        </div>
    </Layout>
</template>

<style scoped>

</style>
