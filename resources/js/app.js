require('./bootstrap');
window.Vue = require('vue');

import store from './vuex/Store';
import router from './router/VueRouter'


const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => {
    if(!key.includes('route-components'))
        Vue.component(key.split('/').pop().split('.')[0], files(key))

});



const app = new Vue({
    el: '#app',
    store,
    router,
});
