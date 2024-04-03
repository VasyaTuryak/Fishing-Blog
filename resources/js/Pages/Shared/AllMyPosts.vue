<script>
import Layout from "@/Pages/Shared/Layout.vue";
import {Head, Link} from "@inertiajs/vue3";
import Create from "@/Pages/Shared/Create.vue";
import NavBarAuthor from "@/Pages/Shared/NavBarAuthor.vue";
import Posts from "@/Pages/Shared/Posts.vue";
import Pagination from "@/Pages/Shared/Pagination.vue";

export default {
    components: {Pagination, Link, Head,NavBarAuthor,Create, Layout,Posts},
    data() {
        return {

        }
    },
    props: {
        userPosts: Object,
    }
}
</script>

<template>
    <Layout>
        <Head>
            <title>Author Page</title>
        </Head>
        <div class="flex flex-row">
            <NavBarAuthor class="w-1/5 sticky"></NavBarAuthor>
            <div class="w-4/5 flex flex-col items-center">
                <Pagination class="fixed" :posts="userPosts"/>
                <Posts :test="userPosts" class="m-4"></Posts>
            </div>
        </div>
    </Layout>
</template>

<style scoped>

</style>
