import Vuex from 'vuex';
import Vue from 'vue';
import mutations from './Mutations';
import actions from './Actions';
import getters from './Getters';

Vue.use(Vuex);

const store = new Vuex.Store({
    state:{
        test: "hello world",
        auth: {
            user:{
                name:'Ethan Brace',
                email:'ethanabrace@gmail.com',
                is_admin:true,
            },

        },
    },
    mutations, actions, getters,
});


export default store;
