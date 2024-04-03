<script setup>
import Nav from "@/Pages/Shared/NavBar.vue";
import {Link} from "@inertiajs/vue3";

</script>

<template>
    <div class="flex  flex-col bg-white sticky top-0 z-50 justify-center mb-6">

        <p v-if="$page.props.auth.user" class="flex justify-end mr-4">USER: {{ $page.props.auth.user.name }}</p>

        <div class="flex flex-row">
            <Link
                :href="`/latest`" class="link">
                <img class="flex flex-row mx-auto" width="200px"
                     src="./../../assets/logo.jpg"
                     alt="Fishing logo">
            </Link>
            <div class="flex flex-col justify-center " style="width: 100%">
                <Nav/>
            </div>
        </div>
    </div>
    <slot/>
    <footer class=" bg-orange-500 ">
        <div>
            <p>FOOTER</p>
        </div>

    </footer>
</template>

<style scoped>

</style>
