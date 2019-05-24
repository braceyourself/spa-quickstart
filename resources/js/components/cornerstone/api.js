import {ApiClient} from "../../clients";

let cornerstone = new ApiClient('/api/cornerstone');

let transactionsApi = new ApiClient('/api/cornerstone/transactions');
transactionsApi.all = ()=>{
    return transactionsApi.get()
};
// transactionsApi.get = (id)=>{
//     return transactionsApi.get(`/${id}`)
// };

// transactionsApi.
export default cornerstone;
export {
    transactionsApi
}
