<template>
    <div class="text-center ">
        <h1>home page?</h1>

    </div>
</template>

<script>
    import Logger from '../../Logger';
    let l = new Logger('home/index');

    export default {
        name: "Home",
        data(){
            return {
                meta:{
                    auth: 'user',
                    nav_position: 0,
                },
            };
        },



    };
</script>

<style scoped>

</style>
