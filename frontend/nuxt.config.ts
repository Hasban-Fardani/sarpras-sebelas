// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },

  modules: [
    "@nuxt/image",
    "@nuxt/fonts",
    "@pinia/nuxt",
    "@nuxtjs/tailwindcss",
    "nuxt-auth-sanctum",
    "./modules/shadcn.ts",
    "./modules/lucide-icon.ts",
  ],

  // generate custom auto import
  imports: {
    imports: [
      {
        from: "vee-validate",
        name: "useForm",
        as: "useForm",
      },
    ],
  },

  runtimeConfig: {
    public: {
      apiBase: process.env.BASE_API_URL ?? "http://localhost:8000/",
    },
  },

  image: {
    format: ["webp"],
    quality: 85,
  },

  sanctum: {
    mode: "token",
    baseUrl: process.env.BASE_API_URL ?? "http://localhost:8000/",
    endpoints: {
      user: "/auth/user",
      login: "/auth/login",
      logout: "/auth/logout",
    },
    redirect: {
      onGuestOnly: "/",
    },
    globalMiddleware: {
      enabled: false,
    },
  },

  compatibilityDate: "2024-09-08",
});
