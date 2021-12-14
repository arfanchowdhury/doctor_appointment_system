import Api from "./ApiService";

export default {
    getUserDetails() {
        return Api().get("user");
    },

    updateUser(id, data) {
        return Api().put("user/update/" + id, data);
    },

    changePassword(data) {
        return Api().post("user/change-password", data);
    }
};