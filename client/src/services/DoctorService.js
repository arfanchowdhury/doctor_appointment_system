import Api from "./ApiService";

export default {
    getDoctors() {
        return Api().get("get-doctors");
    },

    saveDoctor(data) {
        return Api().post("admin/doctor/store", data);
    },

    updateGap(data) {
        return Api().put("doctor/gap/update", data);
    }
};