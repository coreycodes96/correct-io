require('./bootstrap');

import Vue from 'vue';
import store from './store/index';

export const bus = new Vue();

//Headers
Vue.component('guest-header', require('./components/Headers/GuestHeader/GuestHeader.vue').default);
Vue.component('user-header', require('./components/Headers/UserHeader/UserHeader.vue').default);

//Account
Vue.component('create-account', require('./components/Account/CreateAccount/CreateAccount.vue').default);
Vue.component('login', require('./components/Account/Login/Login.vue').default);

//Quiz
Vue.component('quiz-view', require('./components/Quiz/QuizView.vue').default);

const app = new Vue({
    el: '#app',
    store
});
