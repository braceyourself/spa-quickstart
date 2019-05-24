require('./bootstrap');
require('./modals');
import Vue from 'vue';
import router from './router';
import store from './store';
import toastr from './toastr';
import Logger from './Logger';
import VModal from 'vue-js-modal';
Vue.use(VModal, {dynamic:true, injectModalsContainer:true, dynamicDefaults:{clickToClose:false}});


let l = new Logger('app.js');

window.Vue = Vue;

window.flash = (message, type = 'info', options) => {
    toastr[type](message);
};

// eslint-disable-next-line
const files = require.context('./components', true, /\.vue$/i);
files.keys().map(key => {
    let name = _.kebabCase(key.split('/').pop().split('.')[0]);
    let component = files(key).default;
    l.log('new component', name, component);
    Vue.component(name, component)
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
