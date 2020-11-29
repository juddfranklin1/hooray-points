<template>
  <div class="px-4 py-4 w-full">
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
                        v-bind:class="isExactActive ? 'no-underline text-blue-700 bg-gray-200' : isActive && route.name !== 'home' ? 'no-underline text-blue-400 bg-gray-200' : 'hover:bg-gray-200 text-blue-400 bg-gray-50'">{{ route.name }}</a>
                </router-link>
            </li>
            <li v-else class="absolute right-2">
                <template v-if="routeListing.name === 'login'">
                    <button type="button" class="navbar-link" @click="logout()" v-if="isLogged">Logout</button>
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
    <router-view></router-view>
  </div>
</template>
<script>
const default_layout = "default";

import { mapState, mapGetters } from 'vuex';
import store from '../store/';
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
            users: 'user.users',
            rewards: 'reward.rewards',
            actions: 'action.actions',
            userActions: 'userAction.userActions',
            userRewards: 'userReward.userRewards',
        }),
        ...mapGetters([
            'isLogged'
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
            routes
        }
    },
    methods: {
        logout() {
            store.dispatch('logout')
        }
    }
};
</script>
<style lang="scss">
.router-link-active {
    font-weight: bold;
    text-decoration: none;
}
.navbar-link {
    @apply capitalize font-bold p-3;
}
</style>
