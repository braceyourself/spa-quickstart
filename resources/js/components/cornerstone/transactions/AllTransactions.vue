<template>
    <div>
        <card v-for="t in transactions" :key="t.id">
            <div v-for="(v, k) in t" :key="k">
                {{start_case(k)}}:{{v}}
            </div>
        </card>
    </div>
</template>

<script>
    import {transactionsApi} from '../api'
    export default {
        name: "index",
        data(){
            return {
                transactions:[]
            }
        },
        created(){
            transactionsApi.all().then(res => {
                this.transactions = res.data.transactions;
            }).catch(err => {

            })


        }
    }
</script>

<style scoped>

</style>
