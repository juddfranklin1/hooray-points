<template>
  <div class="py-4">
    <h2 class="text-2xl py-4">Rewards</h2>
    <dl>
        <RewardListItem v-for="reward in rewards" :reward="reward" v-bind:key="'reward-' + reward.id"></RewardListItem>
    </dl>
    <UserAddRewardForm :rewards="rewards"></UserAddRewardForm>
  </div>
</template>
<script>
import RewardListItem from './RewardListItem.vue';
import UserAddRewardForm from '../Users/UserAddRewardForm.vue';

export default {
  name: 'RewardList',
  props: {
      'rewards': Array
  },
  components: {
      RewardListItem,
      UserAddRewardForm
  }
};
</script>
