import Api from "./ApiService";

export default {
    getSchedules() {
        return Api().get("doctor/get-schedules");
    },

    updateSchedule(id, schedule) {
        return Api().put("doctor/schedules/update/" + id, schedule);
    },

    getTimingSchedules(doctor_id, date) {
        return Api().get("patient/get-doctor-schedule/" + doctor_id + "/" + date);
    }
};