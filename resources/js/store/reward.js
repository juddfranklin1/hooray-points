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
            return Axios.get('/api/rewards')
                .then(response => commit('setRewards', response.data))
        },
        deleteReward({ commit }, { reward }) {
            return Axios.delete('/api/rewards/' + reward.id)
                .then(response => commit('deleteReward', response.data))
        }
    },
    mutations: {
        setRewards(state, rewards) {
            state.rewards = rewards;
        },
        addReward(state, reward) {
            state.rewards.push(reward);
        },
        updateReward(state, resultReward) {
            state.rewards = [
                ...state.rewards.map(reward => reward.id !== resultReward.id ? reward : {
                    ...reward, ...resultReward
                })]
        },
        deleteReward(state, reward) {
            const deletedReward = state.rewards.findIndex(item => item.id === reward);
            state.rewards.splice(deletedReward, 1);
        },
    }
};
