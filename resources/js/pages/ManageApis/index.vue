<template>
    <div>

        <div class="text-center">Apis</div>


    </div>
</template>

<script>
    import apis from '../../clients/apis'
    import Logger from '../../Logger';

    let l = new Logger('ManageApis');

    export default {
        name: "ApiManager",
        data(){
            return {
                meta:{
                    auth: 'user'
                }
            }
        },
        created(){
            l.log(apis.all());
        }
    }
</script>

<style scoped>

</style>