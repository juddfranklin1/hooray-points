import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import auth from './auth';
import user from './user';
import action from './action';
import reward from './reward';
import userAction from './userAction';
import userGoal from './userGoal';
import userReward from './userReward';

export default new Vuex.Store({
    strict: true,
    modules: {
        auth,
        user,
        action,
        reward,
        userAction,
        userGoal,
        userReward,
    }
});
