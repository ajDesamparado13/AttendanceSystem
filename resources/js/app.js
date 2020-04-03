/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require("./bootstrap");

window.Vue = require("vue");
window._ = require("lodash");
import Vuelidate from "vuelidate";
Vue.use(Vuelidate);
// Install BootstrapVue

import router from "./router/index.js";
import store from "./store/index.js";
import interceptorsSetup from "./boot/axios";

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.needAuth)) {
        if (!store.getters["users/token"]) {
            next("/");
        } else {
            next();
        }
    } else {
        next(); // make sure to always call next()!
    }
});

interceptorsSetup();

const app = new Vue({
    el: "#app",
    router,
    store
});
