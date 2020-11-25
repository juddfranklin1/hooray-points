import Axios from "axios";

// actions
export default {
    state: {
        rewards: []
    },

    getters: {
        getRewardById: state => id => {
            return state.rewards.find(reward => reward.id === id)
        }
    },
    actions: {
        fetchRewards({ commit }, { rewards }) {
            if (rewards) {
                return commit('setRewards', rewards);
            }
            return Axios.get('api/rewards')
                .then(response => commit('setRewards', response.data))
        }
    },
    mutations: {
        setRewards(state, rewards) {
            state.rewards = rewards;
        },
        addReward(state, reward) {
            // test
            console.log(state, reward);
            state.rewards.push(reward);
        },
    }
};
