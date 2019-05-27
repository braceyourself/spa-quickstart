const files = require.context('../components/route-components', true, /\.vue$/i);
import _ from 'lodash';

let routes = [];

// autoload routes
files.keys().map(key => {
    let file = key.split('.')[1];
    let path = `${_.toLower(file)}`;
    let component = require(`../components/route-components${file}.vue`);

    // console.log(file);
    // console.log(path);
    // console.log(component);

	routes.push({
		path,
        component,
        meta:component.data().meta,
	});
});


export default routes;
