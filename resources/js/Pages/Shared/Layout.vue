<script setup>
import Nav from "@/Pages/Shared/Nav.vue";
import {computed} from "vue";


</script>

<template>
<div class="flex flex-col bg-white sticky top-0  justify-center mb-6" >

    <p v-if="$page.props.auth.user" class="flex justify-end mr-4">USER: {{$page.props.auth.user.name}}</p>

    <div class="flex flex-row">
        <div>
            <img class="flex flex-row mx-auto" width="100px" src="https://static.vecteezy.com/system/resources/previews/007/687/479/non_2x/fishing-logo-icon-catch-fish-on-the-boat-outdoor-sunset-silhouette-design-free-vector.jpg" alt="Fishing logo">
        </div>
        <div class="flex flex-col justify-center " style="width: 100%">
            <Nav>
            </Nav>
        </div>
    </div>

</div>
    <slot />
</template>

<style scoped>

</style>
