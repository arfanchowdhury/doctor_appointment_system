import Api from "./ApiService";

export default {
    getSpecialities() {
        return Api().get("admin/specialities");
    },

    saveSpeciality(speciality) {
        return Api().post("admin/specialities", speciality);
    },

    updateSpeciality(id, speciality) {
        return Api().put("admin/specialities/" + id, speciality);
    }
};