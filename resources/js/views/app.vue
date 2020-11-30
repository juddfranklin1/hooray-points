<template>
    <div class="px-4 py-4 w-full relative">
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
                                    <Avatar :username="$store.state.auth.user.user.name"></Avatar>
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
        <router-view></router-view>
    </div>
</template>
<script>
const default_layout = "default";

import { mapState, mapGetters } from 'vuex';
import store from '../store/';
import Avatar from 'vue-avatar';
import routes from '../router/routes.js'

export default {
    props: {
        'usersProp': Array,
        'actionsProp': Array,
        'rewardsProp': Array,
        'userActionsProp': Array,
        'userRewardsProp': Array,
    },
    computed: {
        ...mapState({
            user: 'auth.user',
            users: 'user.users',
            rewards: 'reward.rewards',
            actions: 'action.actions',
            userActions: 'userAction.userActions',
            userRewards: 'userReward.userRewards',
        }),
        ...mapGetters([
            'isLoggedIn'
        ])
    },
    created() {
        store.dispatch('fetchUsers', { users: this.usersProp });
        store.dispatch('fetchActions', { actions: this.actionsProp });
        store.dispatch('fetchRewards', { rewards: this.rewardsProp });
        store.dispatch('fetchUserActions', { userActions: this.userActionsProp });
        store.dispatch('fetchUserRewards', { userRewards: this.userRewardsProp });
    },
    data() {
        return {
            routes,
        }
    },
    methods: {
        logout() {
            store.dispatch('logout')
        }
    },
    components: {
        Avatar
    },
};
</script>
<style lang="scss">
.router-link-active {
    font-weight: bold;
    text-decoration: none;
}
.navbar-link {
    @apply capitalize font-bold p-3 hover:bg-gray-200 text-blue-400 bg-gray-50;
}
</style>
