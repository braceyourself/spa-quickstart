<template>
    <div>
        <div v-if="loading" class="text-center title">loading</div>
        <div v-else>
            <navbar></navbar>

            <!--        <router-link to="/">home</router-link>-->
            <main class="py-4">
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>

<script>
    import Logger from '../../js/Logger';
    import {mapState} from 'vuex';

    let l = new Logger('App.vue');

    export default {
        name: "App",
        created() {
            l.log(this.loading);

        },
        computed: {
            ...mapState(['guest','appName','errors','user','showRegister']),
            loading() {
                l.log('guest', this.guest)
                l.log('appName', this.appName)
                l.log('errors', this.errors)
                l.log('user', this.user)
                l.log('showRegister', this.showRegister)

                return this.guest === undefined ||
                    this.appName === undefined ||
                    this.user === undefined ||
                    this.showRegister === undefined;
            }
        },
        mounted() {
            l.log(__INITIAL_STATE__);
            this.$store.commit('state', __INITIAL_STATE__)
        }
    }
</script>

<style scoped>

</style>