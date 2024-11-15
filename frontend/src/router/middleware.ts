import { useUserStore } from "../stores/user";
import type { Router } from "vue-router";

export const defineMiddleware = (router: Router) => {
	// Login middleware
	router.beforeEach(async (to, _, next) => {
		const user = useUserStore();
		await user.load();

		const isLogin = await user.checkLogin();

		if (to.meta.auth && !isLogin) {
			return next({ path: "/auth/login" });
		}

		// if already logged in, redirect to dashboard/home
		if (to.name === "login" && isLogin) {
			switch (user.data.role) {
				case "admin":
					return next({ path: "/admin/dashboard" });
				case "unit":
					return next({ path: "/user/home" });
				case "pengawas":
					return next({ path: "/supervisor/dashboard" });
			}
		}

		if (to.meta.role && to.meta.role !== user.data.role) {
			return next({ name: "forbidden" });
		}

		return next();
	});
};
