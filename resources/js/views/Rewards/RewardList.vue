<template>
  <div class="my-4 py-3 relative">
    <h1 class="primary-headline">Rewards</h1>
    <div class="absolute top-0 right-0">
        <router-link
            to="/new-reward"
            :users="users"
            v-slot="{ href, navigate, isActive }"
            >
            <a class="action-button" :active="isActive" :href="href" @click="navigate"
                >New Reward</a>
        </router-link>
    </div>
    <router-view></router-view>
    <ul class="max-w-4xl">
        <RewardListItem v-for="reward in rewards" :reward="reward" v-bind:key="'reward-' + reward.id"></RewardListItem>
    </ul>
  </div>
</template>
<script>
import RewardListItem from './RewardListItem.vue';
import RewardForm from './RewardForm.vue';
import { mapState, mapActions } from 'vuex';

export default {
    name: 'RewardList',
    computed: {
        ...mapState({
            users: state => state.user.users,
            actions: state => state.action.actions,
            rewards: state => state.reward.rewards,
        }),
    },
    components: {
        RewardListItem,
        RewardForm
    }
};
</script>

<style>
.action-button {
    @apply py-2 px-4 border-2 border-gray-400 text-blue-400 hover:text-blue-700 hover:border-gray-700;
}
</style>
