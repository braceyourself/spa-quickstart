require('./bootstrap');
import Vue from 'vue';
import router from './router';
import store from './store';
import toastr from './toastr';
import Logger from './Logger';

let l = new Logger('app.js');

window.Vue = Vue;

window.flash = (message, type = 'info', options) => {
    toastr[type](message);
};

// eslint-disable-next-line
const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => {
    let name = key.split('/').pop().split('.')[0];
    Vue.component(name, files(key).default)
});

Vue.mixin({
    methods: {
        get(key) {
            return this.$store.getters.get(key);
        },

    },
});

const app = new Vue({
    el: '#app',
    router, store,
    components: {
        App: require("./layouts/App").default
    },
    created() {
        this.$store.commit('resource', {resource: 'users', data: []});
        this.$store.dispatch('load', 'users');
    }
});
