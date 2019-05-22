<template>
    <div>
        <authorized-clients></authorized-clients>
        <clients></clients>
        <personal-access-tokens></personal-access-tokens>
    </div>
</template>

<script>
    export default {
        name: "OAuth",
        data(){
            return {
                meta:{
                    auth:'user',
                    nav_position: 2
                }
            }
        }
    }
</script>

<style scoped>

</style>