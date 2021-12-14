import Api from "./ApiService";

export default {
    makeAdmin(id, data) {
        return Api().put("admin/make-admin/" + id, data);
    }
};