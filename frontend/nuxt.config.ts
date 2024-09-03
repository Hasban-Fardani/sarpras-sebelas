// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: "2024-04-03",
  devtools: { enabled: true },
  modules: [
    "nuxt-auth-sanctum",
    "@nuxt/image",
    "@nuxt/fonts",
    "@nuxt/ui",
    "@pinia/nuxt"
  ],
  runtimeConfig: {
    public: {
      apiBase: process.env.API_BASE_URL || 'http://localhost:8000/',
    }
  },
  sanctum: {
    endpoints: {
      user: '/me'
    }
  }
});