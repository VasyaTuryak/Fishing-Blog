<script>
import {Head, Link} from "@inertiajs/vue3";
import Layout from "@/Pages/Shared/Layout.vue";


export default {
    components: {Link, Head, Layout},
    data() {
        return {
            msg: this.$page.props.flash.message
        }
    },
    props: [
        'test',
        'msgF'
    ],
    methods: {
        deletePOST(x) {
            let test = {
                DeletePost: x
            }
            this.$inertia.delete(this.route('delete', test))
        },
        editPOST(x) {
            let test = {
                EditPost: x
            }
            this.$inertia.get(this.route('edit'), test)
        },
        flashMSG() {
            this.$page.props.flash.message = ''
        }
    }
}

</script>

<template>
    <div class="flex flex-col w-full m-8 ">
        <div v-if="this.$page.props.flash.message"
             class="bg-green-100 flex flex-row justify-center border border-green-400 text-green-700 px-4 py-3 mb-8 rounded relative"
             role="alert">
            <div class="flex flex-col items-center">
                <p>FLASH MESSAGE: {{this.$page.props.flash.message}}</p>
                <button
                    v-on:click="flashMSG"
                    type="submit"
                >
                    <p class="border border-green-400 p-1 rounded">OK</p>
                </button>
            </div>

        </div>

        <div v-else>
            <div class="w-full listPost mt-4 h-12 flex flex-row" v-if="test.data.length>0" v-for="x in test.data"
                 :key="x.id">
                <Link
                    :href="`/readpost/${x.id}`" class="link w-full "
                >
                    <p>{{ x.title_post }} </p>
                    <p>{{ x.created_at.slice(0, 16).replace('T', '  ') }}</p>
                </Link>

                <div class="flex flex-row">
                    <button
                        v-on:click.prevent="editPOST(x.id)"
                        class="flex flex-row justify-self-center mr-5 px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        Edit
                    </button>
                    <button
                        type="submit"
                        v-on:click.prevent="deletePOST(x.id)"
                        class="flex flex-row justify-self-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        Delete
                    </button>
                </div>
            </div>
            <div v-if="test.total===0">
                <p>Nothing to show, create your first POST, share your experience </p>
            </div>
        </div>

    </div>
</template>

<style scoped>
.listPost:nth-child(even) {
    background: lightgreen;
}

.listPost:nth-child(odd) {
    background: yellow;
}
</style>
