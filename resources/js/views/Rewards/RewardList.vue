<template>
  <div class="my-4 py-3 relative">
    <h1 class="primary-headline">Rewards</h1>
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
