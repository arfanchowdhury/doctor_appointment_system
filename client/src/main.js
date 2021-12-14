import { createApp } from "vue";
import App from "./App.vue";
import Store from "./config/Store";
import env from "./config/env";
import API from "./config/API";
import axios from "axios";
import router from './router/index.js';
import './assets/tailwind.css';

axios.defaults.baseURL = env.baseURL;

window.axios = axios;
window.API = API;
window.Store = Store;

let access_token = Store.getters.getAccessToken;
if (access_token) {
	axios.defaults.headers.common["Authorization"] = `Bearer ${access_token}`;
}

const app = createApp(App);
app.use(Store);
app.use(router);
app.mount("#app");
