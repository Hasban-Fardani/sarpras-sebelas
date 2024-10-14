import "./assets/main.css";
import 'vuetify-sonner/style.css'

import { createPinia } from "pinia";
import { createApp } from "vue";

import App from "./App.vue";
import router from "./router";

// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { VNumberInput } from "vuetify/labs/VNumberInput";

import "@mdi/font/css/materialdesignicons.css";

const customTheme = {
  dark: false,
  colors: {
    background: "#F5F5F5",
    surface: "#FFFFFF",
    primary: "#0B60B0",
    "primary-darken-1": "#094D8D",
    secondary: "#78C651",
    "secondary-darken-1": "#5FA840",
    error: "#B00020",
    info: "#2196F3",
    success: "#4CAF50",
    warning: "#FB8C00",
  },
  variables: {
    "border-color": "#000000",
    "border-opacity": 0.12,
    "high-emphasis-opacity": 0.87,
    "medium-emphasis-opacity": 0.6,
    "disabled-opacity": 0.38,
    "idle-opacity": 0.04,
    "hover-opacity": 0.12,
    "focus-opacity": 0.12,
    "selected-opacity": 0.08,
    "activated-opacity": 0.12,
    "pressed-opacity": 0.12,
    "dragged-opacity": 0.08,
    "theme-kbd": "#212529",
    "theme-on-kbd": "#FFFFFF",
    "theme-code": "#F5F5F5",
    "theme-on-code": "#000000",
  },
};

const vuetify = createVuetify({
  components: {
    ...components,
    VNumberInput,
  },
  directives,
  ssr: true,
  theme: {
    defaultTheme: "customTheme",
    themes: {
      customTheme,
    },
  },
});

const app = createApp(App);

app.use(createPinia());
app.use(vuetify);
app.use(router);

app.mount("#app");
