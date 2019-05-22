import Logger from '../Logger';
import Vue from 'vue';
import VModal from 'vue-js-modal';


let l = new Logger('modals');

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => {
    let name = _.kebabCase(key.split('/').pop().split('.')[0]);
    let component = files(key).default;
    l.log('creating new:', name, component);
    Vue.component(name, component)
});
