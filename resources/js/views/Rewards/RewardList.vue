<template>
    <ul class="max-w-4xl">
        <RewardListItem v-for="reward in rewards" :reward="reward" v-bind:key="'reward-' + reward.id"></RewardListItem>
    </ul>
</template>
<script>
import RewardListItem from './RewardListItem.vue';
import { mapState } from 'vuex';

export default {
    components: {
        RewardListItem
    },
    computed: {
        ...mapState({
            rewards: state => state.reward.rewards,
        }),
    },
}
</script>
