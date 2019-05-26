import Vuex from 'vuex';
import Vue from 'vue';
import router from '../router'

import Logger from '../Logger';

let l = new Logger('store');

Vue.use(Vuex);
// l.log('__INITIAL_STATE__',window.__INITIAL_STATE__);

let store = new Vuex.Store({
    state: {
        ...__INITIAL_STATE__,
        resources: {},
        errors:{}
    },
    mutations: {
        state(state, newState) {
            // let updated_state = Object.assign(state, newState);
            // Vue.set(state, null, updated_state);
            _.forEach(newState, (value, key) => {
                l.log('state', key, value);
                Vue.set(state, key, value)
            })
        },
        resource(state, {resource, data}) {
            l.log('resource', resource, data);
            Vue.set(state['resources'], resource, data);

        },
        errors(state, newError) {
            _.forEach(newError, (value, key) => {
                l.log('new error', key, value);
                Vue.set(state['errors'], key, value)
            })
        }
    },

    actions: {
        load({commit}, resource) {
            axios(`/api/${resource}`).then(res => {
                let resource = 'users';
                let data = res.data;
                commit('resource', {resource, data});
            }).catch(err => {
                l.error(`couldn't load resource ${resource}`);
                l.error(err.response.data.message);
            })

        },
        submitLogin({state,commit}, payload) {
            commit('state', {
                errors:{}
            });
            axios.post('login', payload).then(res => {
                window.location.replace('/home');
            }).catch(err => {
                l.error(err.response.data.message);
                commit('errors',err.response.data.errors);
                commit('errors', {message: err.response.data.message});
            });
        },
        logout({commit}) {
            axios.post('/logout').then(res => {

                commit('state', {
                    user: null,
                    guest: true
                });

                window.location.replace('/');

            }).catch(err => {
                l.log(err);
            });
        }
    },
    getters: {
        get: state => key => {
            let value = state[key];

            l.log('get', key, value);
            return value;
        },
        authenticated(state){
            return state.user !== null;
        }
    }
});
export default store;