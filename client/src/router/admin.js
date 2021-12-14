const CHECK_ROLE = 1;

export default [{
    path: "/admin",
    component: () =>
        import ("../views/dashboard/main.vue"),
    children: [{
            path: "",
            name: "admin.home",
            component: () =>
                import ("../views/admin/home.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
        {
            path: "doctor/create",
            name: "admin.doctor.create",
            component: () =>
                import ("../views/admin/doctor/create.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
        {
            path: "specialities",
            name: "admin.specialities",
            component: () =>
                import ("../views/admin/speciality/index.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
        {
            path: "specialities/create",
            name: "admin.specialities.create",
            component: () =>
                import ("../views/admin/speciality/create.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
        {
            path: "settings",
            name: "admin.settings",
            component: () =>
                import ("../views/change-password.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
    ],
}, ];