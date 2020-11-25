import Axios from "axios";

// actions
export default {
    state: {
        actions: []
    },

    getters: {
        getActionById: state => id => {
            return state.actions.find(action => action.id === id)
        }
    },
    actions: {
        fetchActions({ commit }) {
            return Axios.get('api/actions')
                .then(response => commit('setActions', response.data))
        }
    },
    mutations: {
        setActions(state, actions) {
            state.actions = actions;
        }
    }
};
