require('./bootstrap');

import VueRouter from 'vue-router';
import router from './routes';
import Index from './index.vue';
import StarRating from './components/shared/components/StarRating.vue';
import Vuex from "vuex";
import GlobalStore from "./store";

window.Vue = require('vue');


Vue.use(Vuex);

const store = new Vuex.Store(GlobalStore);
Vue.use(VueRouter);

window.axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === 401) {
            store.dispatch("logOut");
        }

        return Promise.reject(error);
    }
);

Vue.component('star-rating', StarRating);

const app = new Vue({
    el: '#app',
    store,
    components: {
        "index": Index
    },
    router,
    async beforeCreate() {
        this.$store.dispatch("loadState");
        this.$store.dispatch("checkUser");
    },
});

