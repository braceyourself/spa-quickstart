<template>
    <div>
        <card style="margin:0 auto;">
            <div slot="header">Invite User</div>


            <label>Name
                <input type="text" v-model="invite.name" class="form-control">
            </label>
            <label>Email
                <input type="email" v-model="invite.email" class="form-control">
            </label>
            <button class="btn btn-primary" @click="sendInvite()">Send Invite</button>
        </card>

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
                invite:{}
            };
        },
        methods:{
            //
        }



    };
</script>

<style scoped>

</style>