<template>
    <div>

    </div>
</template>

<script>


    export default {
        name: "DynamicComponent",
        data(){
            return {
                params: []
            }
        },
        beforeCreate() {
            // this.params = this.$attrs['test']
        },

        methods:{
            getAttributes() {
                axios('/')
            },

            beforeOpen(e){
                this.params = e.params;
            }
        }
    }
</script>

<style scoped>

</style>
