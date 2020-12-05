import Axios from "axios";

// users
export default {
    state: {
        userGoals: []
    },

    getters: {
        getUserGoalsByUserId: state => id => {
            return state.userGoals.filter(userGoal => userGoal.user.id === id)
        },
        getUserGoalsByGoalId: state => id => {
            return state.userGoals.filter(userGoal => userGoal.goal.id === id)
        },
        getUserGoalsByDate: state => date => {
            return state.userGoals.filter(userGoal => userGoal.created_at == date);// Check date comparator
        },
    },
    actions: {
        fetchUserGoals({ commit }, { userGoals }) {
            if (userGoals) {
                return commit('setUserGoals', userGoals);
            }
            return Axios.get('api/userGoals')
                .then(response => commit('setUserGoals', response.data))
        }
    },
    mutations: {
        setUserGoals(state, userGoals) {
            state.userGoals = userGoals;
        },
        unlinkUserAndGoal({ state, commit }, goal) {

        },
        attachGoalToUser ({ state, commit }, goal) {
            // get the user, add the goal
        },
    }
};
