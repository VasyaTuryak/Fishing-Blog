<script>
import {Head, Link} from '@inertiajs/vue3'
import Layout from "@/Pages/Shared/Layout.vue";

export default {
    components: {Link, Head, Layout},
    emits: ['photo'],
    data() {
        return {
            form: {

            },
            photoLimits: 3,
            flashMessage: false
        }
    },
    props: {
        test: String
    },
computed:{

},
    methods: {
        sendToParent(event) {

            if(event.target.files.length<=this.photoLimits){
                this.flashMessage=false
                this.$emit('photo', this.form)

            }

            if(event.target.files.length>this.photoLimits){
                this.$emit('photo', 'more then 3')
                this.flashMessage=true
                this.form={}
            }
        }
    }
}

</script>

<template>
    <form enctype="multipart/form-data">
        <div class="mb-3 flex flex-row">
            <input type="file" @input="form.photo = $event.target.files" @change="sendToParent" multiple/>
        </div>
    </form>
    <p v-if="flashMessage" class="text-red-500 font-bold">You only can add up to {{photoLimits}} photos. Choose a few less photos </p>
</template>

<style scoped>

</style>
