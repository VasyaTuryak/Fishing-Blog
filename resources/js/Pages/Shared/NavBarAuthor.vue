<script setup>

import {Link} from "@inertiajs/vue3";
</script>

<template>
<div class=" flex flex-col ml-8">
    <Link href="/author-page" class="link hover:text-blue-700 hover:text-2xl mt-4 mb-4"
          :class="[$page.component==='Shared/AuthorPage'&&'font-bold text-blue-600']"
    >Create POST</Link>
    <Link
          :href="route('allMy',$page.props.auth.user.id)"
          class="link hover:text-blue-700 hover:text-2xl mt-4 mb-4"
          :class="[$page.component==='Shared/AllMyPosts'&&'font-bold text-blue-600']"
    >All my posts.</Link>
    <Link href="#" class="link hover:text-blue-700 hover:text-2xl mt-4 mb-4"
    >Rating my posts.</Link>
    <Link href="#" class="link hover:text-blue-700 hover:text-2xl mt-4 mb-4"
    >Comments on my comment</Link>
    <Link href="#" class="link hover:text-blue-700 hover:text-2xl mt-4 mb-4"
    >Save for late reading.</Link>
    <Link
        :href="route('profile.edit')" class="link hover:text-blue-700 hover:text-2xl mt-4 mb-4"
    > PROFILE</Link>


</div>

</template>

<style scoped>

</style>
