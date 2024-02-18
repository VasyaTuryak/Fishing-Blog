<script setup>

import {Link} from "@inertiajs/vue3";
</script>

<template>
<div class=" flex flex-col">
    <Link href="/author-page" class="link hover:text-blue-700 hover:text-2xl mt-4 mb-4"
    >Create POST</Link>
    <Link
          :href="route('allMy',$page.props.auth.user.id)"
          class="link hover:text-blue-700 hover:text-2xl mt-4 mb-4"
    >All my posts.</Link>
    <Link href="#" class="link hover:text-blue-700 hover:text-2xl mt-4 mb-4"
    >Rating my posts.</Link>
    <Link href="#" class="link hover:text-blue-700 hover:text-2xl mt-4 mb-4"
    >Comments on my comment</Link>
    <Link href="#" class="link hover:text-blue-700 hover:text-2xl mt-4 mb-4"
    >Save for late reading.</Link>
</div>

</template>

<style scoped>

</style>
