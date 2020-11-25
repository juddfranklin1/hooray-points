<template>
    <form action="post" @submit.prevent="pickReward($event)" class="border-2 my-3 py-3 px-6 flex flex-col">
        <h3 class="text-2xl pb-4">Redeem a Reward</h3>
        <label for="pick_an_action" class="mt-3 text-lg">What reward does {{ currentUser.name }} choose?</label>
        <select class="px-4 mb-2 py-2 border-2" name="pick_a_reward" id="pick_a_reward">
            <option
                v-for="rewardOpt in rewards"
                v-bind:key="'reward-option-' + rewardOpt.id"
                :value="rewardOpt.id"
                v-bind:disabled="user.point_total < rewardOpt.cost"
            >
                {{ rewardOpt.title }}: {{ rewardOpt.cost }}pts
            </option>
        </select>
        <label for="action_count" class="mt-3 text-lg">How many does {{ currentUser.name }} want?</label>
        <input
            class="mb-2 border-2 py-2 px-4"
            type="number"
            name="multiplier"
            id="reward_count"
            min="1"
            v-bind:max="chosenReward ? currentUser.point_total / chosenReward.cost : 1"
            value="1">
        <button class="px-4 py-2 border-2 hover:bg-gray-200 hover:text-green-400 border-gray-200" type="submit">Add</button>
    </form>
</template>
<script>

import { mapState } from 'vuex';
import store from '../../store/';
import Axios from 'axios';

export default {
    name: 'UserAddRewardForm',
    props: {
        user: Object
    },
    emits: [
        'update-user'
    ],
    methods: {
        pickReward($e) {
            const rewardSelect = $e.target.querySelector('#pick_a_reward');
            const multiplier = $e.target.querySelector('#reward_count');
            const userId = this.currentUser.id;
            Axios.put('/api/user/' + userId + '/addReward/' + rewardSelect.value, {
                multiplier: multiplier.value
            })
                .then(
                    response => {
                        this.currentUser = response.data;
                        this.$emit('update-user', this.currentUser);
                    },
                    error => console.log(error));
        },
        chooseReward($e) {
            this.chosenReward = $e.target.value;
        }
    },
    computed: {
        ...mapState({
            users: state => state.user.users,
            actions: state => state.action.actions,
            rewards: state => state.reward.rewards,
        }),
    },
    data() {
        return {
            chosenReward: null,
            currentUser: this.user,
        }
    }
}
</script>
