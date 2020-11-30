import Axios from 'axios';

export default {
    state: {
      user: null
    },
    mutations: {
      setUserData (state, userData) {
        state.user = userData
        localStorage.setItem('user', JSON.stringify(userData))
        Axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
      },

      clearUserData () {
        localStorage.removeItem('user')
        location.reload()
      }
    },

    actions: {
      login ({ commit }, credentials) {
        return Axios
          .post('api/login', credentials)
          .then(({ data }) => {
            commit('setUserData', data)
          })
      },

      logout ({ commit }) {
        commit('clearUserData')
      }
    },

    getters : {
      isLoggedIn: state => !!state.user,
    }
}
