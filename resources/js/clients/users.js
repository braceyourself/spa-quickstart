import {ApiClient} from "./index";
let users = new ApiClient('/api/users');

export default {
    all(){
        return users.get()
    },
    get(id){
        return users.get(`/${id}`);
    }
};