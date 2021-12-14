import { createApp } from "vue";
import App from "../App.vue";
import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import axios from "axios";

const Store = createStore({
  plugins: [createPersistedState()],
  state() {
    return {
      tokens: {
        access_token: "",
        expires_in: "",
        refresh_token: "",
        token_type: "",
      },
      currentUser: null,
      isSidebarOpen: false,
    };
  },
  actions: {
    login(context, user) {
      return new Promise((resolve, reject) => {
        let data = {
          client_id: 2,
          client_secret: "cUSN245K1Xm5YuCjz8VtNQdWMDlRgHULDaJkJPwW",
          grant_type: "password",
          username: user.email,
          password: user.password,
        };

        axios
          .post(API.login, data)
          .then((response) => {
            let responseData = response.data;
            context.commit("updateTokens", responseData);
            axios.defaults.headers.common[
              "Authorization"
            ] = `Bearer ${responseData.access_token}`;
            resolve(response);
          })
          .catch((response) => {
            reject(response);
          });
      });
    },

    getCurrentUser(context) {
      return new Promise((resolve, reject) => {
        axios
          .get(API.user)
          .then((response) => {
            let responseData = response.data;
            context.commit("updateCurrentUser", responseData);
            resolve(response);
          })
          .catch((response) => {
            reject(response);
          });
      });
    },

    logout(context) {
      return new Promise((resolve, reject) => {
        context.commit("logout");
        delete axios.defaults.headers.common["Authorization"];
        resolve();
      }).catch((response) => {
        reject(response);
      });
    },

    toggleSidebar(context) {
      context.commit("updateSidebarState");
    },

    closeSidebar(context) {
      context.commit("closeSidebar");
    },
  },
  mutations: {
    updateTokens(state, tokens) {
      state.tokens = tokens;
    },
    updateCurrentUser(state, currentUser) {
      state.currentUser = currentUser;
    },
    logout(state) {
      state.currentUser = null;
      state.tokens = "";
    },
    updateSidebarState(state) {
      state.isSidebarOpen = !state.isSidebarOpen;
    },
    closeSidebar(state) {
      state.isSidebarOpen = false;
    },
  },
  getters: {
    getAccessToken(state) {
      return state.tokens.access_token;
    },
    getCurrentUser(state) {
      return state.currentUser;
    },
    getSidebarState(state) {
      return state.isSidebarOpen;
    },
  },
});

const app = createApp(App);
app.use(Store);

export default Store;
