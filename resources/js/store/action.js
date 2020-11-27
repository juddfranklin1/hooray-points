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
        fetchActions({ commit }, { actions }) {
            if (actions) {
                return commit('setActions', actions);
            }
            return Axios.get('api/actions')
                .then(response => commit('setActions', response.data))
        },
        deleteAction({ commit }, { action }) {
            return Axios.delete('api/actions/' + action.id)
                .then(response => commit('deleteAction', response.data))
        }
    },
    mutations: {
        setActions(state, actions) {
            state.actions = actions;
        },
        addAction(state, action) {
            state.actions.push(action);
        },
        deleteAction(state, action) {
            const deletedAction = state.actions.findIndex(item => item.id === action);
            state.actions.splice(deletedAction, 1);
        },
    }
};
