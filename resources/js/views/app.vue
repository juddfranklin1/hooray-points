<template>
  <div class="px-4 py-4 w-full">
    <p>
        <router-link :to="{ name: 'users' }"><span class="hover:no-underline underline text-blue-400">Users</span></router-link> |
        <router-link :to="{ name: 'actions' }"><span class="hover:no-underline underline text-blue-400">Actions</span></router-link> |
        <router-link :to="{ name: 'rewards' }"><span class="hover:no-underline underline text-blue-400">Rewards</span></router-link>
    </p>
    <router-view></router-view>
  </div>
</template>
<script>
const default_layout = "default";

import { mapState } from 'vuex';
import store from '../store/';

export default {
  computed: {
    ...mapState({
        users: state => state.user.users,
        rewards: state => state.reward.rewards,
        actions: state => state.action.actions,
    }),
  },
  created() {
    store.dispatch('fetchUsers');
    store.dispatch('fetchActions');
    store.dispatch('fetchRewards');
  },
};
</script>
