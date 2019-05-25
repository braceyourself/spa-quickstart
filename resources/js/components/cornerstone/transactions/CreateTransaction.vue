<template>
    <div class="p-4">
        <h1>New Transaction</h1>

        <div class="form-group">
            <div class="row justify-content-around">
                <label class="col">Amount
                    <input type="number" v-model="new_transaction.amount">
                </label>
                <label class="col">other field
                    <input type="text">
                </label>
            </div>

            <h3>Occurence</h3>
            <div class="row justify-content-around">
                <div v-for="opt in recurring_options">
                    <label class="p-2 pointer" :class="`btn btn-${new_transaction.recurring == opt ? 'primary':'dark'}`"> {{start_case(opt)}}
                        <input hidden type="radio" :value="opt" v-model="new_transaction.recurring">
                    </label>
                </div>

            </div>


            <div v-if="new_transaction"></div>

            <div class="modal-footer">
                <button @click="close()" class="btn-dark">Cancel</button>
                <button @click="submitDonation" class="btn-success">submit</button>
            </div>
        </div>


    </div>
</template>

<script>
    import Logger from '../../../Logger';

    let l = new Logger('CreateTransaction.vue');
    export default {
        name: "create",
        data(){
            return {
                recurring_options: [
                    'once',
                    'weekly',
                    'monthly',
                    'quarterly',
                    'yearly'
                ],
                customer: {
                    firstname:'ethan',
                    lastname:'brace',
                    email:'eab@frc.org',
                    address:'123 hello dr',
                    company: 'frc',
                    city:'Holland',
                    state:'MI',
                    zip:'49423',
                    country:'US',
                    phone:'123-123-1234',
                    comment: 'hello world'
                },
                check:{
                    aba:'031100393',
                    account:'9999999999',
                    type:'checking'
                },
                new_transaction:{
                    payment:'check',
                    amount:null,
                    merchant:'frc capture sandbox',
                    startdate:null,
                    installments:1,
                    type:null,
                    oneitem:true,
                    memo:null,
                    copy_to:null,
                    fee:0,
                    name:'Donation Payment',
                    display_login:null,
                    'callback_field[id]':null,
                    'callback_field[status]':null,
                    'callback_field[message]':null,
                    'memo[APPEAL]':'APPEALCODE',
                    callback:'api.frc.org/cornerstone/transactions/callback',
                }
            }
        },
        methods:{
            calculatedClass(opt){
                return 'btn btn-'+this.new_transaction.recurring === opt ?
                    'primary':'dark'
            },
            submitDonation() {
                this.pending = true;
                let data = this.new_transaction;

                _.forEach(this.customer, (v,k) => {
                    data[`customer[${k}]`] = v;
                });
                _.forEach(this.check, (v,k) => {
                    data[`check[${k}]`] = v;
                });


                axios.post(`/api/cornerstone/transactions`, data).then(res => {
                    this.pending = false;
                    let response = res.data.response;

                    if(response.error){
                        flash(response.reason,'error')
                    }else
                        this.close();

                    l.log(res.data);
                }).catch(err => {
                    l.log(err)
                })
            },
            close(){

                this.$modal.hide('create-transaction');
            }
        }
    }
</script>

<style scoped>

</style>
