import store from './store/'
import Axios from 'axios';
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';// The big UI framework
import 'vuetify/dist/vuetify.min.css'

Vue.use(VueRouter)
Vue.use(Vuetify)


import App from './views/app.vue';
import routes from './router/routes.js'

const router = new VueRouter({
    routes,
    mode: 'history',
    scrollBehavior (to, from, savedPosition) {
        if (to.hash) {
          return {
            selector: to.hash
            // , offset: { x: 0, y: 10 }
          }
        }
    }
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user')

    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
      next('/login')
      return
    }
    next()
});

const app = new Vue({
    vuetify: new Vuetify(),
    el: '#app',
    components: { App },
    created () {
        const userInfo = localStorage.getItem('user')
        if (userInfo) {
          const userData = JSON.parse(userInfo)
          this.$store.commit('setUser', userData)
        }
        Axios.interceptors.response.use(
          response => response,
          error => {
            if (error.response.status === 401) {
              this.$store.dispatch('logout')
            }
            return Promise.reject(error)
          }
        )
    },
    router,
    store,
});

