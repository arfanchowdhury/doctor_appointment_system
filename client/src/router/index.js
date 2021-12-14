import { createRouter, createWebHistory } from "vue-router";
import AuthRoutes from "./auth";
import AdminRoutes from "./admin";
import DoctorRoutes from "./doctor";
import PatientRoutes from "./patient";

const router = createRouter({
    history: createWebHistory(),
    routes: [{
            path: "/",
            redirect: {
                name: "auth.login"
            }
        },
        ...AuthRoutes,
        ...AdminRoutes,
        ...DoctorRoutes,
        ...PatientRoutes,
        {
            path: "/:pathMatch(.*)*",
            name: "error.404",
            component: () =>
                import ("../views/error/404.vue"),
        },
    ],
});

router.beforeEach((to, from, next) => {
    const USER = Store.getters.getCurrentUser;
    const ROLE_ID = USER ? USER.role_id : 0;
    const IS_LOGGED_IN = USER ? true : false;

    if (to.meta.requiresAuth) {
        if (IS_LOGGED_IN && to.meta.checkRole === USER.role_id) {
            next();
        } else {
            next({ name: "auth.login" });
        }
    } else {
        if (IS_LOGGED_IN && (to.name === "auth.login" || to.name === "auth.register")) {
            if (ROLE_ID === 1) {
                router.push({ name: "admin.home" });
            } else if (ROLE_ID === 2) {
                router.push({ name: "doctor.home" });
            } else if (ROLE_ID === 3) {
                router.push({ name: "patient.home" });
            }
        } else {
            next();
        }
    }
});

export default router;