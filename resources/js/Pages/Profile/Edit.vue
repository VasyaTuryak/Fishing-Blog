<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import Layout from "@/Pages/Shared/Layout.vue";
import Posts from "@/Pages/Shared/Posts.vue";
import Pagination from "@/Pages/Shared/Pagination.vue";
import NavBarAuthor from "@/Pages/Shared/NavBarAuthor.vue";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
<div>




    <Layout>
        <Head>
            <title>Author Page</title>
        </Head>
        <div class="flex flex-row">
            <NavBarAuthor class="w-1/5"></NavBarAuthor>
<div class="flex flex-col items-center w-full">
    <div>
        <p>Logo/photo</p>
        <p>Short my description (other user can see this) </p>
        <p>Rating my post / number of stars </p>
        <p>Total number posts</p>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl"
                />
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <UpdatePasswordForm class="max-w-xl" />
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </div>
</div>
        </div>
    </Layout>




</div>
</template>
