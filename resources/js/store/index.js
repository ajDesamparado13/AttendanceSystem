import Vue from "vue";
import Vuex from "vuex";
import users from "./users";
import roles from "./roles";
import company from "./company";
import employees from "./employees";
import machines from "./machines";
import createPersistedState from "vuex-persistedstate";
Vue.use(Vuex);

const Store = new Vuex.Store({
    plugins: [createPersistedState()],
    modules: {
        users,
        company,
        employees,
        roles,
        machines
    }
});

export default Store;
