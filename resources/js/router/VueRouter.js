import VueRouter from 'vue-router';
import Vue from 'vue';
import routes from './VueRoutes';
import store from '../vuex/Store';

Vue.use(VueRouter);


// let Unauthorized = require('../components/partials');

const router = new VueRouter({
    routes,
    mode:'history',
    beforeEach: (to, from, next) =>{
        if(to.meta.admin || to.path.includes('admin')){
            if(store.state.auth.user.is_admin){
                next()
            }else{
                next({component:Vue.component('Unauthorized')})
            }
        }
	}
});


export default router;

