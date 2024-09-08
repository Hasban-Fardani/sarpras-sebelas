// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },

  modules: [
    "@nuxt/image",
    "@nuxt/fonts",
    "@pinia/nuxt",
    "@nuxtjs/tailwindcss",
    "nuxt-auth-sanctum",
    './modules/shadcn.ts',
  ],

  runtimeConfig: {
    public: {
      apiBase: process.env.BASE_API_URL ?? 'http://localhost:8000/',
    }
  },

  sanctum: {
    baseUrl: process.env.BASE_API_URL ?? 'http://localhost:8000/',
    endpoints: {
      user: '/auth/user'
    },
    globalMiddleware: {
      enabled: false
    },
  },

  compatibilityDate: "2024-09-08",
});