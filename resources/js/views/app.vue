<template>
    <div class="w-full relative">
        <Navbar></Navbar>
        <main class="mx-auto px-4 xl:px-0 max-w-6xl">
            <router-view></router-view>
        </main>
    </div>
</template>
<script>
const default_layout = "default";

import { mapState, mapGetters } from 'vuex';
import store from '../store/';
import Navbar from './components/Navbar.vue';

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
    components: {
        Navbar
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
