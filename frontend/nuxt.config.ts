// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  // devtools: { enabled: true },
  experimental: {
    watcher: "chokidar",
  },

  modules: [
    "@nuxt/image",
    "@nuxt/fonts",
    "@pinia/nuxt",
    "@nuxtjs/tailwindcss",
    "@vueuse/nuxt",
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
      apiBase: process.env.BASE_API_URL ?? "https://api.sarpras.hasbanfardani.my.id",
    },
  },

  image: {
    format: ["webp"],
    quality: 85,
  },

  sanctum: {
    mode: "token",
    baseUrl: process.env.BASE_API_URL ?? "https://api.sarpras.hasbanfardani.my.id",
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

  tailwindcss: {
    config: {
      content: [
        "./components/**/*.vue",
        "./layouts/**/*.vue",
        "./pages/**/*.vue",
        "./composables/**/*.{js,ts}",
      ],
    },
  },

  compatibilityDate: "2024-09-08",
});
