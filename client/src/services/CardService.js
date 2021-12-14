import Api from "./ApiService";

export default {
    getUserCardDetails() {
        return Api().get("get-user-card-details");
    },

    getAdminCardDetails() {
        return Api().get("admin/get-admin-card-details");
    }
};