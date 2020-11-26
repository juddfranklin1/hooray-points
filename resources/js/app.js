import store from './store/'
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import VueTailwind from 'vue-tailwind'// Component Library
import vueTailwindSettings from './vueTailwind.js'

Vue.use(VueRouter)
Vue.use(Vuex)
Vue.use(VueTailwind, vueTailwindSettings)


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

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store,
});

