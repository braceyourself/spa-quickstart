<template>
    <div>
        <data-table :data="apis"
               style="width:100%;"
               @created="createApi"
               @delete="deleteApi"
               @update="updateApi"
        ></data-table>

        <button @click="test">Click</button>

    </div>
</template>

<script>
    import apis from '../../clients/apis'
    import Logger from '../../Logger';
    import dialog from '../../Dialog';
    import TestModal from '../../modals/CreateResource'

    let l = new Logger('ManageApis');

    export default {
        name: "ApiManager",
        data() {
            return {
                meta: {
                    auth: 'user',

                },
                apis: [],
                opens:0
            }
        },
        computed: {
            //

        },
        methods: {
            test() {
                this.$modal.show(require('../../modals/CreateResource').default,{
                    resourceName: 'api'
                });
            },
            createApi() {
                this.apis.push({});
            },
            deleteApi(api) {
                console.log('deleting api', api);
            },
            updateApi(api){

            }
        },
        created() {
            apis.all().then(res => {
                this.apis = res.data;
                l.log(res);

            })
        }
    }
</script>

<style scoped lang="scss">
    .table {
        /*wrap-option: ;*/
        overflow-x: scroll;

        .col {
        }
    }

</style>
