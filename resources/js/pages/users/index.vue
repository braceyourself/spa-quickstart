<template>
    <div>
        <div v-if="users.length === 0">Loading Users...</div>
        <div v-else>
            <div v-for="user in users">
                <div>Name: {{user.name}}</div>
                <div>Email: {{user.email}}</div>
            </div>
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
                }
            };
        },
        computed: {
            users() {
                return this.resources.users;
            },
            ...mapState(['resources']),
        }
    }
</script>

<style scoped>

</style>