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
        <div v-if="users.length === 0">Loading Users...</div>
        <div v-else>
            <card v-for="user in users" :key="user.id">
                <div>Name: {{user.name}}</div>
                <div>Email: {{user.email}}</div>
            </card>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        name: "Users",
        data() {
            return {
                meta: {
                    auth:'user',
                },
                invite:{}
            };
        },
        methods:{
            sendInvite(){
                axios.post('invite-user', this.invite).then(res =>{
                    this.$router.push('/users');

                }).catch(err =>{
                    alert(err.response.data.message);
                });
            }
        },
        computed: {
            users() {
                return this.resources.users;
            },
            ...mapState(['resources']),
        },
    }
</script>

<style scoped>

</style>
