<script setup>

import Layout from "@/Pages/Shared/Layout.vue";
import {Head} from "@inertiajs/vue3";
</script>

<template>
    <Layout>
        <Head>
            <title>Latest post</title>
        </Head>
        <br>
        <div class="flex flex-col ">
            <div>
                <p>LATEST created posts all users with pagination </p>
            </div>
            <br>
            <div class="grid grid-cols-4 gap-4">
                <div style="width: 100px; height: 100px; background-color: red; color: white">POST</div>
                <div style="width: 100px; height: 100px; background-color: red; color: white">POST</div>
                <div style="width: 100px; height: 100px; background-color: red; color: white">POST</div>
                <div style="width: 100px; height: 100px; background-color: red; color: white">POST</div>
                <div style="width: 100px; height: 100px; background-color: red; color: white">POST</div>
                <div style="width: 100px; height: 100px; background-color: red; color: white">POST</div>
                <div style="width: 100px; height: 100px; background-color: red; color: white">POST</div>
                <div style="width: 100px; height: 100px; background-color: red; color: white">POST</div>
                <div style="width: 100px; height: 100px; background-color: red; color: white">POST</div>
            </div>
        </div>
    </Layout>
</template>

<style scoped>

</style>
