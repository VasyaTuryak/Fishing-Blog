<script setup>
// import Layout from './Layout'
import { Head } from '@inertiajs/vue3'

defineProps({ user: Object })
</script>

<template>
        <Head title="Welcome" />
        <h1>Welcome</h1>
        <p>Hello {{user}}, welcome to your first Inertia app!</p>
</template>
