import Home from '../views/Home.vue';
import ActionIndex from '../views/Actions/ActionIndex.vue';
import ActionList from '../views/Actions/ActionList.vue';
import ActionForm from '../views/Actions/ActionForm.vue';
import UserIndex from '../views/Users/UserIndex.vue';
import UserList from '../views/Users/UserList.vue';
import UserSingle from '../views/Users/UserSingle.vue';
import ActionSingle from '../views/Actions/ActionSingle.vue';
import RewardIndex from '../views/Rewards/RewardIndex.vue';
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
        path: '/actions',
        name: 'actions',
        meta: {
            auth: true
        },
        component: ActionIndex,
        children: [
            {
                path: '/',
                name: 'actions',
                component: ActionList
            },
            {
                path: ':id',
                name: 'action',
                component: ActionSingle,
                props: true
            },
            {
                path: 'new',
                name: 'new-action',
                components: {
                    default: ActionList,
                    modal: ActionForm,
                },
                props: true
            },
            {
                path: ':id/edit',
                name: 'edit-action',
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
        component: RewardIndex,
        props: true,
        children: [
            {
                path: '/',
                name: 'rewards',
                component: RewardList,
                props: true
            },
            {
                path: 'new',
                name: 'new-reward',
                components: {
                    default: RewardList,
                    modal: RewardForm,
                },
                props: true
            },
            {
                path: ':id/edit',
                name: 'edit-reward',
                component: RewardForm,
                props: true
            },

        ]
    },
    {
        path: '/users',
        name: 'users',
        meta: {
            auth: true
        },
        component: UserIndex,
        children: [
            {
                path: '',
                name: 'default',
                component: UserList
            },
            {
                path: '/',
                name: 'users',
                component: UserList
            },
            {
                path: ':id',
                name: 'user',
                meta: {
                    auth: true
                },
                component: UserSingle,
                props: true
            },
        ]
    },
];
