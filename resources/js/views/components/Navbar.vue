<template>
    <nav class="navigation--primary">
        <ul class="flex">
            <!-- Need a better way to handle top-level links without relying upon "children array" and presence of a colon to indicate argument-free paths -->
            <template v-for="(routeListing, index) in routes">
                <li
                    v-bind:key="'route-listing-' + index"
                    v-if="routeListing.path.indexOf(':') === -1 && routeListing.name !== 'login' && routeListing.name !== 'logout'"
                    class="mr-3"
                >
                    <router-link
                        :to="{ name: routeListing.name }"
                        v-bind:key="routeListing.path"
                        v-slot="{ href, route, navigate, isActive, isExactActive }"
                    >
                        <a
                            :href="href"
                            @click="navigate"
                            :isActive="isActive"
                            :isExactActive="isExactActive"
                            class="navbar-link"
                            v-bind:class="isExactActive ? 'no-underline text-blue-700 bg-gray-200' : isActive && route.name !== 'home' ? 'no-underline text-blue-400 bg-gray-200' : ''">{{ route.name }}</a>
                    </router-link>
                </li>
                <li v-bind:key="'route-listing-' + index" v-if="routeListing.name === 'login'" class="absolute right-2">
                    <template>
                        <button type="button" class="navbar-link" @click="logout()" v-if="isLoggedIn">Logout</button>
                        <router-link
                            v-else
                            :to="{ name: routeListing.name }"
                            v-bind:key="routeListing.path"
                            v-slot="{ href, route, navigate, isActive, isExactActive }"
                        >
                            <a
                                :href="href"
                                @click="navigate"
                                :isActive="isActive"
                                :isExactActive="isExactActive"
                                class="navbar-link"
                                v-bind:class="isExactActive ? 'no-underline text-blue-700 bg-gray-200' : isActive && route.name !== 'home' ? 'no-underline text-blue-400 bg-gray-200' : 'hover:bg-gray-200 text-blue-400 bg-gray-50'">{{ route.name }}</a>
                        </router-link>

                    </template>
                </li>
            </template>
        </ul>
    </nav>
</template>
<script>
import Avatar from 'vue-avatar'

export default {
    name: 'Navbar',
    components: [
        'Avatar'
    ]
}
</script>
