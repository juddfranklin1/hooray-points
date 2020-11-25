<template>
  <div class="py-4">
    <h2 class="text-2xl py-4">Rewards</h2>
    <dl>
        <RewardListItem v-for="reward in rewards" :reward="reward" v-bind:key="'reward-' + reward.id"></RewardListItem>
    </dl>
    <RewardForm :users="users"></RewardForm>
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
