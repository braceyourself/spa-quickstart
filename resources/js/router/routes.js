import _ from 'lodash';
import Vue from 'vue';
import Logger from '../Logger';
import store from '../store'

let l = new Logger('routes.js');

let routes = [];

const files = require.context('../pages', true, /\.vue$/i);
files.keys().map(key => {

   let name = key.split('/').pop().split('.')[0];
   let path = key.split('.')[1];
   let component = files(key).default;
   let route = {
      path, component,
      name:_.startCase(component.name),
   };

   let data = {};
   if (_.isFunction(component.data)) {
      data = component.data();
   }

   route.meta = data.meta || {};

   try{
      // set data.meta.nav or data.nav to 'false' to hide in navbar
      route.nav = data.meta.nav === undefined ?
          data.nav === undefined ?
              true
              : data.nav
          : data.meta.nav;

      // if neither are defined - set the default
   } catch (e) { route.nav = true; }


   if (route.path.includes('index')) {
      route.path = route.path.replace("/index","/")
   }
   let route_parts = route.path.split('/');
   _.each(route_parts, (v,i) =>{
       route_parts[i] = _.kebabCase(v);
   });

   route.path = route_parts.join('/');

   l.log('route', route);
   let authorized_to_view = false;
   let user = store.state.user;
   let guest = store.state.guest;
   let route_auth = route.meta.auth || null;


   l.log('guest', guest);
   l.log('user', user);

   if (route_auth === undefined || route_auth === null) {
      authorized_to_view = true;
   } else if (route_auth === 'guest') {
      authorized_to_view = guest && user === null;
   } else if (route_auth === 'user') {
      authorized_to_view = user !== undefined && user !== null;
   } else if (user && route_auth === 'admin') {
      authorized_to_view =  user.admin;
   }


   route.meta.authorized = authorized_to_view;

   l.log('authorized', route.meta.authorized);

   routes.push(route);
   l.log(key, name, path, component);
});




export default routes;