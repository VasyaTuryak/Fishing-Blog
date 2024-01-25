<script setup>
import {Link} from "@inertiajs/vue3";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});
</script>

<template>
    <nav >
        <div class="flex justify-between">
            <div>
                <Link href="/home" class="link" :class="{'font-bold text-blue-600': $page.component==='Home'}">HOME</Link>
                <Link href="/latest" class="link"
                      :class="{'font-bold text-blue-600': $page.component==='Shared/latestpost'}"
                >LATEST POST</Link>
                <Link href="/search" class="link"
                      :class="{'font-bold text-blue-600': $page.component==='Shared/Search'}"
                >SEARCH FOR POST</Link>
                <Link href="/weather" class="link"
                      :class="{'font-bold text-blue-600': $page.component==='Shared/Weather'}"
                >WEATHER ON DNISTER</Link>
                <Link href="/nasa" class="link"
                      :class="{'font-bold text-blue-600': $page.component==='Shared/nasa'}"
                >PHOTO STAR SKY FROM NASA</Link>


                <Link href="/about" class="link"
                      :class="{'font-bold text-blue-600': $page.component==='About/About'}"
                >ABOUT PROJECT</Link>
                <Link href="/contact" class="link"
                      :class="{'font-bold text-blue-600': $page.component==='Contact/Contact'}"
                >CONTACT</Link>
            </div>
            <div>
                <Link
                    v-if="!$page.props.auth.user"
                    :href="route('login')" class="link"
                    :class="{'font-bold text-blue-600': $page.component==='Auth/Login'}"
                >LOG IN </Link>
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('logout')" method="post" as="button" class="link"
                    :class="{'font-bold text-blue-600': $page.component==='Auth/Login'}"
                >LOG OUT</Link>
                <Link
                    v-if="!$page.props.auth.user"
                    :href="route('register')" class="link"
                    :class="{'font-bold text-blue-600': $page.component==='Auth/Logout'}"
                >REGISTER</Link>
                <Link  v-if="$page.props.auth.user"
                       href="/author-page" class="link"
                       :class="{'font-bold text-blue-600': $page.component==='Shared/Authorpage'}"
                >AUTHOR PAGE</Link>
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('profile.edit')" class="link"
                    :class="{'font-bold text-blue-600': $page.component==='Profile/Edit'}"
                > PROFILE</Link>
            </div>
        </div>
    </nav>
</template>

<style scoped>
.link{
    margin-left: 10px;
    margin-right: 10px;
}

</style>
