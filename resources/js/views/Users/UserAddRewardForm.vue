<template>
    <form action="post" @submit.prevent="addRewardToUser($event)">
        <h3 class="text-2xl pb-4">Redeem a Reward</h3>
        <label for="pick_an_action" class="mt-3 text-lg">What reward does {{ currentUser.name }} choose?</label>
        <v-select
            outlined
            value-attribute="id"
            text-attribute="name"
            :items="[
                {
                    text: 'pick a reward',
                    value: ''
                },
                ...rewards
            ]"
            @change="chooseReward"
            name="pick_a_reward"
            id="pick_a_reward" />

        <template v-if="chosenReward">
            <label for="action_count" class="mt-3 text-lg">How many does {{ currentUser.name }} want?</label>
            <v-text-field
                outlined
                type="number"
                name="multiplier"
                id="reward_count"
                min="1"
                :max="maxRewardCount"
                value="1" />
            <v-btn
                color="primary"
                class="trigger-button"
                type="submit"
                >Add</v-btn>
        </template>
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
        addRewardToUser($e) {
            const multiplier = $e.target.querySelector('#reward_count');
            const userId = this.currentUser.id;
            Axios.put('/api/users/' + userId + '/attachReward/' + this.chosenReward, {
                multiplier: multiplier.value
            })
                .then(
                    response => {
                        this.currentUser = response.data;
                        this.$store.commit('updateUser', this.currentUser);
                        this.$emit('update-user', this.currentUser);
                    },
                    error => console.log(error));
        },
        chooseReward($e) {
            this.chosenReward = $e;
            const reward = this.rewards.find(rew => rew.value == this.chosenReward);
            this.maxRewardCount = this.currentUser.point_total / reward.cost;
        }
    },
    computed: {
        ...mapState({
            users: state => state.user.users,
            actions: state => state.action.actions,
            rewards: function(state) {
                const that = this;
                return state.reward.rewards.map(reward => {
                    const opt = {
                        value: reward.id,
                        text: reward.title + ': ' + reward.cost + ' pts',
                        cost: reward.cost
                    }

                    if(that.currentUser.point_total < reward.cost) {
                        opt.disabled=true
                    }
                    return opt;
                })
            }
        }),
    },
    data() {
        return {
            chosenReward: null,
            currentUser: this.user,
            maxRewardCount: 1
        }
    }
}
</script>
