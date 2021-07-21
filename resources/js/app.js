
require('./bootstrap');
import Vue from 'vue';
import store from './store/index';
import routes from './router/index';


const app = new Vue({
    el: '#app',
    store,
    router: routes,
});
