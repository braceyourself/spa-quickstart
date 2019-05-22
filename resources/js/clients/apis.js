import {ApiClient} from './index';
let client = new ApiClient('/api/apis');
export default {
    all(){
        return client.get()
    },
    get(id){
        return client.get(`/${id}`);
    }
};
