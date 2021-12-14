import Api from "./ApiService";

export default {
    getPatientForAdmin() {
        return Api().get("admin/get-patients");
    },

    getPatientForDoctor() {
        return Api().get("doctor/get-patients");
    },
};