<template>
    <nav class="bg-blue-100 navigation--primary">
        <ul class="px-4 xl:px-0 flex align-center justify-start relative mx-auto max-w-6xl">
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
                            class="navbar-link flex"
                            v-bind:class="isExactActive ? 'no-underline text-blue-700 border-blue-700' : isActive && route.name !== 'home' ? 'no-underline text-blue-400 bg-gray-100 d-inline' : ''">
                            <Hooray v-if="route.name === 'home'" />
                            <span v-else>{{ route.name }}</span>
                            </a>
                    </router-link>
                </li>
                <li v-bind:key="'route-listing-' + index" v-if="routeListing.name === 'login'" class="absolute top-2 right-2">
                    <a
                        v-if="isLoggedIn"
                        aria-label="User menu"
                        aria-haspopup="true"
                        @click.stop="drawer = !drawer"
                        >
                        <Avatar :username="$store.state.auth.user.user.name" :size="42"></Avatar>
                    </a>
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
                            class="navbar-link--text"
                            v-bind:class="isExactActive ? 'no-underline text-blue-700 bg-gray-200' : isActive && route.name !== 'home' ? 'no-underline text-blue-400 bg-gray-200' : 'hover:bg-gray-200 text-blue-400 bg-gray-50'">{{ route.name }}</a>
                    </router-link>
                </li>
            </template>
        </ul>
        <v-navigation-drawer
            v-model="drawer"
            absolute
            right
            temporary>
            <v-list>
                <li>
                    <router-link
                        :to="{name: 'user', params: { id: $store.state.auth.user.user.id }}"
                        v-slot="{ href, navigate, isActive }"
                        >
                        <a class="text-center navbar-link" :active="isActive" :href="href" @click="navigate"
                            >Profile</a>
                    </router-link>
                </li>
                <li>
                    <button type="button" class="mt-3 navbar-link" @click="logout()">Logout</button>
                </li>
            </v-list>
        </v-navigation-drawer>
    </nav>
</template>
<script>

import store from '../../store/';
import { mapState, mapGetters } from 'vuex';
import Avatar from 'vue-avatar';
import Hooray from '../components/icons/Hooray';
import routes from '../../router/routes.js';

export default {
    name: 'Navbar',
    components: {
        Avatar,
        Hooray
    },
    data() {
        return {
            routes,
            drawer: false
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
<style lang="scss">
    .navigation--primary {
        .navbar-link {
            min-height: 58px;
            line-height: 40px;
        }
    }
</style>
