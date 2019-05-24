<template>
    <td>
        <slot>
            <div v-if="editable">
                <input type="text" :value="text">
            </div>
            <div v-else>{{text}}</div>
        </slot>

    </td>
</template>

<script>
    export default {
        name: "TableColumn",
        data(){
            return {

            }
        },
        props:{
            editable:false,
            text:''
        }
    }
</script>

<style scoped>

</style>
