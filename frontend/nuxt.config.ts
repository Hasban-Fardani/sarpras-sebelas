// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: "2024-04-03",
  devtools: { enabled: true },
  modules: [
    "nuxt-auth-sanctum", 
    "@nuxt/image", 
    "@nuxt/fonts", 
    "@nuxt/ui"
  ],

  sanctum: {
    endpoints: {
      user: '/me'
    }
  }
});
