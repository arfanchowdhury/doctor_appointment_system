export default [
	{
		path: "/login",
		name: "auth.login",
		component: () => import("../views/auth/login.vue"),
	},
	{
		path: "/register",
		name: "auth.register",
		component: () => import("../views/auth/register.vue"),
	},
];
