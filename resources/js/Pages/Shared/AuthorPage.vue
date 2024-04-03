<script>
import Layout from "@/Pages/Shared/Layout.vue";
import {Head, Link} from "@inertiajs/vue3";
import Create from "@/Pages/Shared/Create.vue";
import NavBarAuthor from "@/Pages/Shared/NavBarAuthor.vue";

export default {
    components: {Link, Head,NavBarAuthor,Create, Layout},
    data() {
        return {
            indexInArray: 0,
        }
    },
    props: {
        posts: Array,
        errors: Object
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
        <Create class="ml-25" :test="errors"></Create>
    </div>
</div>

</Layout>
</template>

<style scoped>

</style>
