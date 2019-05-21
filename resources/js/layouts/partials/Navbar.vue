<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <router-link class="navbar-brand" to="/">
                    {{appName}}
                </router-link>
                <button class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <div v-if="guest || user === null">
                            <li class="nav-item">
                                <router-link class="nav-link" to="/login">Login</router-link>
                            </li>
                            <li v-if="showRegister" class="nav-item">
                                <router-link class="nav-link" to="/register">Register</router-link>
                            </li>

                        </div>

                        <li v-else class="nav-item dropdown">

                            <div id="navbarDropdown"
                                 class="nav-link dropdown-toggle pointer"
                                 role="button"
                                 data-toggle="dropdown"
                                 aria-haspopup="true"
                                 aria-expanded="false">

                                <span v-if="user">{{user.name}}</span>
                                <span v-else>Menu</span>
                                <span class="caret"></span>
                            </div>

                            <div class="dropdown-menu dropdown-menu-right">
                                <router-link class="dropdown-item pointer"
                                             :to="route.path"
                                             :key="route.path"
                                             v-if="route.nav && route.meta.authorized"
                                             v-for="route in routes">{{route.name}}
                                </router-link>
                                <div class="dropdown-item pointer"
                                     @click="logout()">
                                    Logout
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex';
    import Logger from '../../Logger';

    let l = new Logger('Navbar.vue');

    export default {
        name: "Navbar",
        computed: {
            routes() {
                let routes = this.$router.options.routes;
                l.log(routes);

                let i = 0;
                routes.sort((a, b) => {
                    return (a.meta.nav_position || i) - (b.meta.nav_position || ++i)
                });

                l.log(routes);
                return routes;
            },
            showLink(e) {
                console.log(e);
            },
            ...mapState(['user', 'guest', 'appName', 'showRegister']),
        },
        methods: {
            ...mapActions(['logout']),
        }
    }
</script>
