import Home from '../views/Home.vue';
import ActionList from '../views/Actions/ActionList.vue';
import ActionForm from '../views/Actions/ActionForm.vue';
import UserList from '../views/Users/UserList.vue';
import SingleUser from '../views/Users/SingleUser.vue';
import SingleAction from '../views/Actions/SingleAction.vue';
import RewardList from '../views/Rewards/RewardList.vue';
import RewardForm from '../views/Rewards/RewardForm.vue';
import Login from '../views/Auth/Login.vue';

export default [
    {
        path: '/',
        name: 'home',
        component: Home,
        props: true
    },
    {
        path: '/login',
        name: 'login',
        component: Login
        // component: () => import(/* webpackChunkName: "login" */ '../views/Login.vue') - for lazy loading
    },
    {
        path: '/users',
        name: 'users',
        meta: {
            auth: true
        },
        component: UserList,
        props: true,
        children: [
        ]
    },
    {
        path: '/user/:id',
        name: 'user',
        meta: {
            auth: true
        },
        component: SingleUser,
        props: true
    },
    {
        path: '/actions',
        name: 'actions',
        meta: {
            auth: true
        },
        component: ActionList,
        props: true,
        children: [
            {
                path: '/action/:id',
                name: 'action',
                component: SingleAction,
                props: true
            },
            {
                path: '/new-action',
                name: 'new-action',
                component: ActionForm,
                props: true
            },
        ]
    },
    {
        path: '/rewards',
        name: 'rewards',
        meta: {
            auth: true
        },
        component: RewardList,
        props: true,
        children: [
            {
                path: '/new-reward',
                name: 'new-reward',
                component: RewardForm,
                props: true
            }
        ]
    },
];
