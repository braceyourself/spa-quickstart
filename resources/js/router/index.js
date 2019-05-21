import VueRouter from 'vue-router';
import Vue from 'vue';
import routes from './routes';
import Logger from '../Logger';
import store from '../store'
import toastr from '../toastr.js'
import axios from 'axios';

let l = new Logger('router');

Vue.use(VueRouter);

let router = new VueRouter({
    mode: 'history',
    routes,
});


router.beforeEach((to, from, next) => {
    toastr.clear();

    l.log('to', to);
    l.log('from', from);
    // l.log('guest', guest);
    // l.log('user', user);



    if (to.meta.authorized) next();
    else {
        // next('/');
        if (to.meta.auth) {
            flash(`That page is only for ${to.meta.auth}s.`);
        }else
            flash(`That page is off limits for you!.`);

    }
});

export default router;

