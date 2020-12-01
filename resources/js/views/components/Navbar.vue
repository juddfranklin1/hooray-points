<template>
    <nav class="bg-blue-100 navigation--primary">
        <ul class="px-4 py-4 flex relative mx-auto max-w-6xl">
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
                <li v-bind:key="'route-listing-' + index" v-if="routeListing.name === 'login'" class="absolute top-2 right-2">
                    <t-dropdown text="Menu" v-if="isLoggedIn">
                        <div
                            slot="trigger"
                            slot-scope="{
                            mousedownHandler,
                            focusHandler,
                            blurHandler,
                            keydownHandler
                            }"
                        >
                            <a
                                aria-label="User menu"
                                aria-haspopup="true"
                                @mousedown="mousedownHandler"
                                @focus="focusHandler"
                                @blur="blurHandler"
                                @keydown="keydownHandler">
                                <Avatar :username="$store.state.auth.user.user.name" :size="42"></Avatar>
                            </a>
                        </div>
                        <div
                            slot-scope="{ hide }"
                            @click="hide"
                            class="py-1 flex flex-col rounded-md shadow-xs">
                            <router-link
                                :to="{name: 'user', params: { id: $store.state.auth.user.user.id }}"
                                v-slot="{ href, navigate, isActive }"
                                >
                                <a class="text-center navbar-link" :active="isActive" :href="href" @click="navigate"
                                    >Profile</a>
                            </router-link>
                            <button type="button" class="mt-3 navbar-link" @click="logout()">Logout</button>
                        </div>
                    </t-dropdown>
                    <router-link
                        v-if="!isLoggedIn"
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
                </li>
            </template>
        </ul>
    </nav>
</template>
<script>

import store from '../../store/';
import { mapState, mapGetters } from 'vuex';
import Avatar from 'vue-avatar';
import routes from '../../router/routes.js';

export default {
    name: 'Navbar',
    components: {
        'Avatar': Avatar
    },
    data() {
        return {
            routes,
        }
    },
    computed: {
        ...mapState({
            user: 'auth.user',
        }),
        ...mapGetters([
            'isLoggedIn'
        ])
    },
    methods: {
        logout() {
            store.dispatch('logout')
        }
    },
}
</script>
