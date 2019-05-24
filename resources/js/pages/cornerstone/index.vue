<template>
    <div>

        <button class="btn-primary" @click="$modal.show('create-transaction')">Create a transaction</button>
        <modal name="create-transaction" @close="$modal.hide('create-transaction')">
            <create-transaction />
        </modal>
        <all-transactions></all-transactions>

    </div>
</template>

<script>
    // import CreateTransaction from '../../components/cornerstone/transactions/CreateTransaction';
    // import AllTransactions from '../../cornerstone/transactions/create';
    // import ShowTransaction from '../../cornerstone/transactions/create';

    export default {
        name: "CornerstoneTransactions",
        data(){
            return {
                meta:{
                    auth:'user'
                }
            }
        }
    }
</script>

<style scoped>

</style>
