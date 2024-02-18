<script>
export default {
    props: [
       'test'
    ],
}
</script>

<template>
    <div>
        <ol v-if="test.length>0">
            <li v-for="x in test">NAME of Post: {{ x.title_post }}</li>
        </ol>
        <ol v-if="test.length===0">
            <li>Nothing to show, create your first POST, share your experience </li>
        </ol>

    </div>
</template>

<style scoped>

</style>
