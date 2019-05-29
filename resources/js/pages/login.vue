<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <div>
                            <div class="form-group row">
                                <label class="px-4">
                                    E-Mail Address
                                    <input id="login-email" type="email" class="form-control"
                                           :class="errorsInclude('email') ? ' is-invalid' : ''"
                                           v-model="login.email"
                                           required autofocus>

                                    <span v-if="errorsInclude('email')" class="invalid-feedback" role="alert">
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
                                           :class="errorsInclude('password') ? ' is-invalid' : ''"
                                           required>
                                    <span v-if="errorsInclude('password')" class="invalid-feedback" role="alert">
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
    import {mapActions} from 'vuex';

    let l = new Logger('login.vue');

    export default {
        name: "login",
        data() {
            return {
                meta: {
                    auth: 'guest'
                },
                login: {},
                errors: []
            }
        },
        methods: {
            ...mapActions(['submitLogin']),

            errorsInclude(key) {
                return false;
            },
            showForgotPasswordLink() {
                return false;
            }
        }
    }
</script>

<style scoped>

</style>
