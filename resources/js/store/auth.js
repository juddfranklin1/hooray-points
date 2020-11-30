import Axios from 'axios';

export default {
    state: {
      user: null
    },
    mutations: {
      setUser (state, userData) {
        state.user = userData
        localStorage.setItem('user', JSON.stringify(userData))
        Axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
      },

      clearUser () {
        localStorage.removeItem('user')
        location.reload()
      }
    },

    actions: {
      login ({ commit }, credentials) {
        return Axios
          .post('api/login', credentials)
          .then(({ data }) => {
            commit('setUser', data)
          })
      },

      logout ({ commit }) {
        commit('clearUser')
      }
    },

    getters : {
      isLoggedIn: state => !!state.user,
    }
}
