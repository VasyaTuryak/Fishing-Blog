<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Pagination",
    components: {Link},
    props:{
        posts: Object
    }
}
</script>

<template>
    <div  class=" flex flex-row">
        <div class="m-1"
             v-for="link in posts.links">
            <div >
                <Link
                    preserve-scroll
                    v-if="link.url"
                    :href="link.url"
                    v-html="link.label"
                    :class="{'text-gray-200': !link.url, 'font-bold text-rose-500 ': link.active }"
                />
                <span v-else v-html="link.label" class="text-gray-200"></span>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
