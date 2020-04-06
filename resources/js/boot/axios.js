import store from "../store/index";

window.axios = require("axios");
// const appMode = (type) =>
//     ({
//         live: "",
//         test: "http://localhost:8000/api",
//         local: "",
//     }[type]);
let APP_URL = process.env.MIX_APP_URL;
axios.defaults.baseURL = APP_URL;
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
axios.defaults.headers.post["Content-Type"] = "application/json";

export default function setup() {
    axios.interceptors.request.use(
        function (config) {
            const token = store.getters["users/token"];
            if (token) {
                config.headers.Authorization = `Bearer ${token}`;
            }
            return config;
        },
        function (err) {
            return Promise.reject(err);
        }
    );
}
