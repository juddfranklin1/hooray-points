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
            return Axios.get('/api/users')
                .then(response => commit('setUsers', response.data))
        }
    },
    mutations: {
        setUsers(state, users) {
            state.users = users;
        },
        addUser(state, resultUser) {
            state.users.push(resultUser);
        },
        updateUser(state, resultUser) {
            state.users = [
                ...state.users.map(user => user.id !== resultUser.id ? user : {
                    ...user, ...resultUser
                })]
        },
        deleteUser(state, user) {
            const deletedUser = state.users.findIndex(item => item.id === user);
            state.actions.splice(deletedUser, 1);
        },
    }
};
