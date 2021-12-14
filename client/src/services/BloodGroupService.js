import Api from "./ApiService";

export default {
    getBloodGroups() {
        return Api().get("get-blood-groups");
    },
};