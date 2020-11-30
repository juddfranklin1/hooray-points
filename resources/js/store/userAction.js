import Axios from "axios";

// users
export default {
    state: {
        userActions: []
    },

    getters: {
        getUserActionsByUserId: state => id => {
            return state.userActions.filter(userAction => userAction.user.id === id)
        },
        getUserActionsByActionId: state => id => {
            return state.userActions.filter(userAction => userAction.action.id === id)
        },
        getUserActionsByDate: state => date => {
            return state.userActions.filter(userAction => userAction.created_at == date);// Check date comparator
        },
    },
    actions: {
        fetchUserActions({ commit }, { userActions }) {
            if (userActions) {
                return commit('setUserActions', userActions);
            }
            return Axios.get('api/userActions')
                .then(response => commit('setUserActions', response.data))
        }
    },
    mutations: {
        setUserActions(state, userActions) {
            state.userActions = userActions;
        },
        unlinkUserAndAction({ state, commit }, action) {

        },
        addActionToUser ({ state, commit }, action) {
            // get the user, add the action
        },
    }
};
