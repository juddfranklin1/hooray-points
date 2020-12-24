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
        'userGoalsProp': Array,
        'userRewardsProp': Array,
    },
    computed: {
        ...mapState({
            user: 'auth.user',
            users: 'user.users',
            rewards: 'reward.rewards',
            actions: 'action.actions',
            userActions: 'userAction.userActions',
            userGoals: 'userGoal.userGoals',
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
        store.dispatch('fetchUserGoals', { userGoals: this.userGoalsProp });
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
    @apply capitalize font-bold px-3 py-2 border-b-2 border-blue-100 hover:border-blue-600;
    &--text {
        @apply text-blue-600 underline hover:no-underline bg-transparent;
    }
}
</style>
