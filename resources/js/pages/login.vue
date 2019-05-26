<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">

                        <strong v-if="errors['message']"
                                class="text-center is-invalid d-block"
                                role="alert">
                            {{ errors['message'] }}
                        </strong>

                        <div>
                            <div class="form-group row">
                                <label class="px-4">
                                    E-Mail Address
                                    <input id="login-email" type="email" class="form-control"
                                           :class="errors['email'] ? ' is-invalid' : ''"
                                           v-model="login.email"
                                           required autofocus>

                                    <span v-if="errors['email']" class="invalid-feedback" role="alert">
                                        <strong>{{ errors['email'][0] }}</strong>
                                    </span>
                                </label>
                            </div>

                            <div class="form-group row">
                                <label class="px-4">
                                    Password
                                    <input id="login-password" type="password"
                                           v-model="login.password"
                                           class="form-control"
                                           :class="errors['password'] ? ' is-invalid' : ''"
                                           required>
                                    <span v-if="errors['password']" class="invalid-feedback" role="alert">
                                        <strong>{{ errors['password'][0] }}</strong>
                                    </span>
                                </label>

                            </div>


                            <div>
                                <button @click="submitLogin(login)" class="btn btn-primary">
                                    Login
                                </button>

                                <router-link v-if="showForgotPasswordLink()" class="btn btn-link" to="reset-password">
                                    Forgot Your Password?
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Logger from '../Logger';
    import {ApiClient} from "../clients";

    let api = new ApiClient('/api');
    import {mapActions, mapState} from 'vuex';

    let l = new Logger('login.vue');

    export default {
        name: "login",
        data() {
            return {
                meta: {
                    auth: 'guest'
                },
                login: {},
            }
        },
        computed: {
            ...mapState(['errors']),
        },
        methods: {
            ...mapActions(['submitLogin']),

            showForgotPasswordLink() {
                return false;
            }
        }
    }
</script>

<style scoped>

</style>