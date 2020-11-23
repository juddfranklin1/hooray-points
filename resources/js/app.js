import Vue from 'vue';
import VueRouter from 'vue-router';
import { createStore } from 'vuex';

Vue.use(VueRouter)

import App from './views/app.vue';
import ActionList from './views/Actions/ActionList.vue';
import ActionForm from './views/Actions/ActionForm.vue';
import UserList from './views/Users/UserList.vue';
import SingleUser from './views/Users/SingleUser.vue';
import SingleAction from './views/Actions/SingleAction.vue';
import RewardList from './views/Rewards/RewardList.vue';
import RewardForm from './views/Rewards/RewardForm.vue';

// const store = createStore({
//     state() {
//         return {
//             actions: 'stuff',
//             users: 'things',
//             rewards: 'other things'
//         }
//     }
// });

const routes = [
    {
        path: '/user/:id',
        name: 'user',
        component: SingleUser,
        props: true
    },
    {
        path: '/users',
        name: 'users',
        component: UserList,
        props: true
    },
    {
        path: '/action/:id',
        name: 'action',
        component: SingleAction,
        props: true
    },
    {
        path: '/actions',
        name: 'actions',
        component: ActionList,
        props: true
    },
    {
        path: '/new-action',
        name: 'new-action',
        component: ActionForm,
        props: true
    },
    {
        path: '/rewards',
        name: 'rewards',
        component: RewardList,
        props: true
    },
    {
        path: '/new-reward',
        name: 'new-reward',
        component: RewardForm,
        props: true
    }
]

const router = new VueRouter({
    routes // short for `routes: routes`
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});

// app.use(store);

