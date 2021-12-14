const CHECK_ROLE = 3;

export default [{
    path: "/patient",
    component: () =>
        import ("../views/dashboard/main.vue"),
    children: [{
            path: "",
            name: "patient.home",
            component: () =>
                import ("../views/patient/home.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
        {
            path: "appointment/create",
            name: "patient.appointment.create",
            component: () =>
                import ("../views/patient/appointment.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
        {
            path: "ambulance",
            name: "patient.ambulance",
            component: () =>
                import ("../views/patient/ambulance.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
        {
            path: "hospital",
            name: "patient.hospital",
            component: () =>
                import ("../views/patient/hospital.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
        {
            path: "blood-donation",
            name: "patient.blood",
            component: () =>
                import ("../views/patient/blood.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
        {
            path: "medicine",
            name: "patient.medicine",
            component: () =>
                import ("../views/patient/medicine.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
        {
            path: "covid-note",
            name: "patient.covid",
            component: () =>
                import ("../views/patient/covid.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
        {
            path: "profile",
            name: "patient.profile",
            component: () =>
                import ("../views/profile.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
        {
            path: "settings",
            name: "patient.settings",
            component: () =>
                import ("../views/change-password.vue"),
            meta: { requiresAuth: true, checkRole: CHECK_ROLE },
        },
    ],
}, ];