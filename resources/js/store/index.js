import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

import user from './user';
import action from './action';
import reward from './reward';

export default new Vuex.Store({
    strict: true,
    modules: {
        user,
        action,
        reward
    }
});
