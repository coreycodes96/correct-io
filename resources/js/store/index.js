import Vue from 'vue';
import Vuex from 'vuex';

import account from './modules/account.js';
import quiz from './modules/quiz.js';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        account,
        quiz,
    }
});