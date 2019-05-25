<template>
    <tr>
        <slot>
            <table-column v-for="(col,i) in columns" :key="i"/>
        </slot>


        <table-column class="table-button-container">
            <div><i class="material-icons">edit</i></div>

<!--            <div v-if="editRow">-->
<!--                <button @click="saveEdit">save</button>-->
<!--                <button @click="cancelEdit">cancel</button>-->
<!--            </div>-->
<!--            <div v-else-if="newRow">-->
<!--                <button @click="editRow(row)">edit</button>-->
<!--                <button class="danger" @click="$emit('delete', row)">delete</button>-->
<!--            </div>-->
<!--            <div v-else>-->
<!--                -->
<!--            </div>-->

        </table-column>

    </tr>
</template>

<script>
    export default {
        name: "TableRow",
        data() {
            return {
                editing_row:false
            };
        },
        props: {
            columns: [],
            editRow:{
                default:false,
                type:Boolean
            },
            newRow:{
                default:false,
                type:Boolean
            }
        }
    }
</script>

<style scoped>

</style>
