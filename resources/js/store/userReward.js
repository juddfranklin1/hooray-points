import Axios from "axios";

// users
export default {
    state: {
        userRewards: []
    },

    getters: {
        getUserRewardsByUserId: state => id => {
            return state.userRewards.filter(userReward => userReward.user.id === id)
        },
        getUserRewardsByRewardId: state => id => {
            return state.userRewards.filter(userReward => userReward.Reward.id === id)
        },
        getUserRewardsByDate: state => date => {
            return state.userRewards.filter(userReward => userReward.created_at == date);// Check date comparator
        },
    },
    actions: {
        fetchUserRewards({ commit }, { userRewards }) {
            if (userRewards) {
                return commit('setUserRewards', userRewards);
            }
            return Axios.get('api/userRewards')
                .then(response => commit('setUserRewards', response.data))
        }
    },
    mutations: {
        setUserRewards(state, userRewards) {
            state.userRewards = userRewards;
        },
        unlinkUserAndReward({ state, commit }, Reward) {
            // get the User, detach the Reward
        },
        attachRewardToUser ({ state, commit }, Reward) {
            // get the User, attach the Reward
        },
    }
};
