<template>
  <div class="px-4 py-4 w-full">
    <ul class="flex">
        <!-- Need a better way to handle top-level links without relying upon "children array" -->
        <router-link
            v-for="routeListing in routes"
            :to="{ name: routeListing.name }"
            v-if="routeListing.path.indexOf(':') === -1"
            v-bind:key="routeListing.path"
            v-slot="{ href, route, navigate, isExactActive }"
        >
            <li class="mr-3">
                <a
                    :href="href"
                    @click="navigate"
                    :isExactActive="isExactActive"
                    class="p-3"
                    v-bind:class="isExactActive ? 'no-underline text-blue-700 bg-gray-200' : 'hover:bg-gray-200 text-blue-400 bg-gray-50'">{{ route.name }}</a>
            </li>
        </router-link>
    </ul>
    <router-view></router-view>
  </div>
</template>
<script>
const default_layout = "default";

import { mapState } from 'vuex';
import store from '../store/';
import routes from '../router/routes.js'

export default {
    props: {
        'usersProp': Array,
        'actionsProp': Array,
        'rewardsProp': Array
    },
    computed: {
        ...mapState({
            users: state => state.user.users,
            rewards: state => state.reward.rewards,
            actions: state => state.action.actions,
        })
    },
    created() {
        store.dispatch('fetchUsers', { users: this.usersProp });
        store.dispatch('fetchActions', { actions: this.actionsProp });
        store.dispatch('fetchRewards', { rewards: this.rewardsProp });
    },
    data() {
        return {
            routes
        }
    }
};
</script>
<style lang="scss" scoped>
.router-link-active {
    font-weight: bold;
    text-decoration: none;
}
</style>
