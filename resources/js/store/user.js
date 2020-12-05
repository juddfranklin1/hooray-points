import Axios from "axios";

// users
export default {
    state: {
        users: []
    },

    getters: {
        getUserById: state => id => {
            return state.users.find(user => user.id === id)
        }
    },
    actions: {
        fetchUsers({ commit }, { users }) {
            if (users) {
                return commit('setUsers', users);
            }
            return Axios.get('api/users')
                .then(response => commit('setUsers', response.data))
        }
    },
    mutations: {
        setUsers(state, users) {
            state.users = users;
        },
        attachActionToUser ({ state, commit }, action) {
            // get the user, add the action
        },

        attachRewardToUser ({ state, commit }, reward) {
            // get the user, add the reward

        },
    }
};
